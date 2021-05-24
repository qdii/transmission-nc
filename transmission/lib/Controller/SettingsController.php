<?php
namespace OCA\Transmission\Controller;

use OCP\IConfig;
use OCP\IRequest;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;

class SettingsController extends Controller {
    private $config;

    public function __construct($AppName, IRequest $request, IConfig $config){
        parent::__construct($AppName, $request);
        $this->config = $config;
    }

    public function save() {
        $port = $this->request->getParam("port");
        $is_valid = preg_match("/^[1-9][0-9]*$/", $port);
        if ($is_valid != 1) {
            return new DataResponse("Invalid port number.", 422);
        }
        $this->config->setAppValue('transmission', 'rpc-port', $port);

        $username = $this->request->getParam("username");
        $this->config->setAppValue('transmission', 'rpc-username', $username);

        $password = $this->request->getParam("password");
        $this->config->setAppValue('transmission', 'rpc-password', $password);

        return new DataResponse('success');
    }

}
