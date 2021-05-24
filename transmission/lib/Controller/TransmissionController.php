<?php
namespace OCA\Transmission\Controller;

use OCP\IConfig;
use OCP\ILogger;
use OCP\IRequest;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;

class TransmissionController extends Controller {
    private $config;
    private $logger;

    private function getRPCPort() {
        return $this->config->getAppValue($this->appName, 'rpc-port', '9091');
    }

    public function __construct($AppName, IRequest $request, IConfig $Config, ILogger $logger){
        parent::__construct($AppName, $request);
        $this->config = $Config;
        $this->logger = $logger;
    }

    public function rpc($method, $arguments) {
        $host = "transmission";
        $port = $this->getRPCPort();
        $url = 'http://' . $host . ':' . $port . '/transmission/rpc';
        $headers_to_forward = [
            'X-Transmission-Session-Id'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        $data = [
            'method' => $method,
            'arguments' => $arguments,
        ];

        $sent_headers = [];

        // Forward X-Transmission-Session-Id
        foreach (getallheaders() as $header => $value) {
            if (strcmp($header, 'X-Transmission-Session-Id') == 0) {
                array_push($sent_headers, 'X-Transmission-Session-Id: ' . $value);
            }
        }

        // Enable Basic Authentication, if username or password is set.
        $username = $this->config->getAppValue('transmission', 'rpc-username', '');
        $password = $this->config->getAppValue('transmission', 'rpc-password', '');
        if (!empty($username) || !empty($password)) {
            $creds = base64_encode($username . ':' . $password);
            array_push($sent_headers, 'Authorization: Basic ' . $creds);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $sent_headers);

        $response = curl_exec($ch);
        $code = curl_getinfo($ch,  CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headers = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        curl_close($ch);

        $headerArray = $this->get_headers_from_curl_response($response);
        $json_response = new JSONResponse(json_decode($body), $code);
        foreach($headerArray as $name => $value)
        {
            if (!in_array($name, $headers_to_forward)) {
                continue;
            }
            $json_response->addHeader($name, $value);
        }
        return $json_response;
    }

    private function get_headers_from_curl_response($response) {
        $headers = array();
        $header_text = substr($response, 0, strpos($response, "\r\n\r\n"));
        foreach (explode("\r\n", $header_text) as $i => $line)
            if ($i === 0)
                $headers['http_code'] = $line;
            else
            {
                list ($key, $value) = explode(': ', $line);
                $headers[$key] = $value;
            }
        return $headers;
    }
}
