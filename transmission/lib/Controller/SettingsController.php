<?php
namespace OCA\Transmission\Controller;

use OCP\IConfig;
use OCP\IRequest;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;

class SettingsController extends Controller {
    private $userId;
    private $config;

    public function __construct($AppName, IRequest $request, $UserId, IConfig $Config){
        parent::__construct($AppName, $request);
        $this->userId = $UserId;
        $this->config = $Config;
    }

    public function save() {
        $host = $this->request->getParams['host'];
        $this->config->setUserValue($this->userId, $this->appName, 'host', $host);

        $port = $this->request->getParams['port'];
        $this->config->setUserValue($this->userId, $this->appName, 'port', $port);
    }

}
