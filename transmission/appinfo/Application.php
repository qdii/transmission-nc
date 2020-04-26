<?php
namespace OCA\Transmission\AppInfo;

use \OCP\AppFramework\App;
use \OCA\Transmission\Controller\TransmissionController;
use \OCA\Transmission\Controller\PageController;
use \OCA\Transmission\Settings\Admin;

class Application extends App {

    public function __construct(array $urlParams=array()){
        parent::__construct('transmission', $urlParams);

        $container = $this->getContainer();

        /**
         * Config
         */
        $container->registerService('Config', function($c) {
            return $c->query('ServerContainer')->getConfig();
        });

        /**
         * Controllers
         */
        $container->registerService('TransmissionController', function($c) {
            return new TransmissionController(
                $c->query('AppName'),
                $c->query('Request'),
                $c->query('UserId'),
                $c->query('Config')
            );
        });
        $container->registerService('PageController', function($c) {
            return new PageController(
                $c->query('AppName'),
                $c->query('Request'),
                $c->query('UserId'),
                $c->query('Config')
            );
        });

        $container->registerService('Admin', function($c) {
            return new Admin(
                $c->query('AppName'),
                $c->query('UserId'),
                $c->query('Config')
            );
        });
    }
}
?>
