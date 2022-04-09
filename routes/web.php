<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return view('app');
});


$router->group([
    'prefix' => 'api'
], function() use ($router) {

	$router->get('processor', 'ApiController@processor');

	$router->get('file-systems', 'ApiController@fileSystems');

	$router->get('last-login', 'ApiController@lastLogin');

	$router->get('load', 'ApiController@load');

	$router->get('memory', 'ApiController@memory');

	$router->get('system', 'ApiController@system');

	$router->get('docker', 'ApiController@docker');

	$router->get('utilization', 'ApiController@utilization');

});
