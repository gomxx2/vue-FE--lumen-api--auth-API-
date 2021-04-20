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
    return $router->app->version();
});

$router->get('/contact', 'ContactController@index');
$router->post('/contact', 'ContactController@store');
$router->get('/contact/{id}', 'ContactController@show');
$router->put('/contact/{id}', 'ContactController@update');
$router->delete('/contact/{id}', 'ContactController@destroy');

$router->get('/calls', 'CallsController@index');
$router->post('/calls', 'CallsController@store');
$router->get('/calls/{id}', 'CallsController@show');
$router->put('/calls/{id}', 'CallsController@update');
$router->delete('/calls/{id}', 'CallsController@destroy');


$router->get('/callstt', 'CallsController@show_calls');

$router->delete('/callstt/{id}', 'CallsController@deleteAllTimeline');

//gk jadi pake ini
$router->post('/relation', 'CallsController@store_relation');