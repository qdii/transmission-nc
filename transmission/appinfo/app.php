<?php

$app = \OC::$server->query(\OCA\Transmission\AppInfo\Application::class);
$app->registerHooks();

