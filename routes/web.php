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
    $router->get('{serviceName}/{url}', 'GeneralController@getData');
    $router->get('{serviceName}/{url}/{param}', 'GeneralController@getByParam');
});

// Apotek Routes
$router->group(['prefix' => 'apotek'], function () use ($router) {
    $router->group(['prefix' => 'referensi'], function () use ($router) {
        $router->get('dpho', 'ApotekReferensiController@getDpho');
        $router->get('poli/{param}', 'ApotekReferensiController@getPoli');
        $router->get('ppk/{param1}/{param2}', 'ApotekReferensiController@getFasilitasKesehatan');
        $router->get('setting/{param}', 'ApotekReferensiController@getSetting');
        $router->get('spesialistik', 'ApotekReferensiController@getSpesialistik');
        $router->get('obat/{param1}/{param2}/{param3}', 'ApotekReferensiController@getObat');
    });
});