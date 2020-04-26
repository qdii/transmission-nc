<?php
namespace OCA\Transmission\AppInfo;

use \OCP\AppFramework\App;
use \OCA\Transmission\Controller\TransmissionController;

class Application extends App {

    public function __construct(array $urlParams=array()){
        parent::__construct('transmission', $urlParams);

        $container = $this->getContainer();

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
    }
}
?>
