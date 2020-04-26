<?php
return [
    'routes' => [
	   ['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
	   ['name' => 'transmission#rpc', 'url' => '/rpc', 'verb' => 'POST'],
	   ['name' => 'settings#save', 'url' => '/save', 'verb' => 'POST'],
    ]
];
