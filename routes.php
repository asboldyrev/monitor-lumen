<?php

use Bramus\Router\Router;

/**
 * @var Router $router
 */

$router->setNamespace('\Asboldyrev\Monitor\Controllers');

$router->mount('/api', function() use ($router) {

	$router->get('/processor', 'ApiController@processor');

	$router->get('/file-systems', 'ApiController@fileSystems');

	$router->get('/last-login', 'ApiController@lastLogin');

});

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');

	echo 'Not Found';
});