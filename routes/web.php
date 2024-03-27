<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\Apotek\ReferensiController;

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

$router->group(['prefix' => 'bpjs'], function () use ($router) {
    $router->get('decrypt', 'SignatureController@getDecrypt');
    $router->get('encrypt', 'SignatureController@getEncrypt');
});

$router->group(['prefix' => 'apotek'], function () use ($router) {
    $router->group(['prefix' => 'referensi'], function () use ($router) {
        $router->get('dpho', 'ApotekReferensiController@getDpho');
        $router->get('poli/{id}', 'ApotekReferensiController@getPoli');
    });
});