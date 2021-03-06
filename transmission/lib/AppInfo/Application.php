<?php
namespace OCA\Transmission\AppInfo;

use \OCP\AppFramework\App;
use \OCA\Transmission\Controller\TransmissionController;
use \OCA\Transmission\Controller\PageController;
use \OCA\Transmission\Controller\SettingsController;

class Application extends App {

    public function __construct(array $urlParams=array()){
        parent::__construct('transmission', $urlParams);

        $container = $this->getContainer();

        /**
         * Config
         */
        $container->registerService('Config', function($c) {
            return $c->query(\OCP\IServerContainer::class)->getConfig();
        });

        /**
         * Controllers
         */
        $container->registerService('TransmissionController', function($c) {
            return new TransmissionController(
                'transmission',
                $c->query(\OCP\IRequest::class),
                $c->query(\OCP\IConfig::class),
                $c->query(\OCP\ILogger::class)
            );
        });
        $container->registerService('PageController', function($c) {
            return new PageController(
                'transmission',
                $c->query(\OCP\IRequest::class),
                $c->query(\OCP\IConfig::class),
                $c->query(\OCP\ILogger::class)
            );
        });
        $container->registerService('SettingsController', function($c) {
            return new SettingsController(
                'transmission',
                $c->query(\OCP\IRequest::class),
                $c->query(\OCP\IConfig::class)
            );
        });

    }
    public function registerHooks() {
    }
}
?>
