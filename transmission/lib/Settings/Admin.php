<?php

namespace OCA\Transmission\Settings;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\IL10N;
use OCP\Settings\ISettings;

class Admin implements ISettings {
    private $appName;
    /** @var IL10N */
    private $l;
    private $userId;
    private $config;

    /**
     * @param IL10N $l
     */
    public function __construct($AppName, $UserId, IL10N $l, IConfig $Config) {
        $this->appName = $AppName;
        $this->userId = $UserId;
        $this->l = $l;
        $this->config = $Config;
    }

    /**
     * @return TemplateResponse
     */
    public function getForm() {
        $parameters = [
            'host' => $this->config->getUserValue($this->appName, $this->userId, 'host'),
            'port' => $this->config->getUserValue($this->appName, $this->userId, 'port'),
        ];

        return new TemplateResponse('transmission', 'settings', $parameters);
    }

    public function getSection() {
        return 'server';
    }

    public function getPriority() {
        return 100;
    }
}
