<?php
namespace OCA\Transmission\Settings;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\IConfig;
use OCP\Settings\ISettings;

class Settings implements ISettings {

	private $config;

    public function __construct(IConfig $config) {
		$this->config = $config;
    }

    public function getForm() {
        $response = new TemplateResponse('transmission', 'settings');
        $response->setParams([
			'rpc-port' => $this->config->getAppValue('transmission', 'rpc-port', '9091'),
			'rpc-username' => $this->config->getAppValue('transmission', 'rpc-username', ''),
			'rpc-password' => $this->config->getAppValue('transmission', 'rpc-password', ''),
		]);
        return $response;
    }

    public function getSection() {
        return 'sharing';
    }

    public function getPriority() {
        return 50;
    }
}
