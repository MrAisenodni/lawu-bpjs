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
    $router->get('{serviceName}/{url}', 'GeneralController@apiData');
    $router->get('{serviceName}/{url}/{param}', 'GeneralController@getByParam');
});

// V-CLaim Routes
$router->get('/vclaim/{serviceName:.*}', 'VClaimController@apiData');
$router->post('/vclaim/{serviceName:.*}', 'VClaimController@apiData');
$router->put('/vclaim/{serviceName:.*}', 'VClaimController@apiData');
$router->delete('/vclaim/{serviceName:.*}', 'VClaimController@apiData');

// Apotek Routes
$router->group(['prefix' => 'apotek'], function () use ($router) {
    // Referensi Routes
    $router->group(['prefix' => 'referensi'], function () use ($router) {
        $router->get('dpho', 'ApotekController@apiData');
        $router->get('poli/{param}', 'ApotekController@apiData');
        $router->get('ppk/{param1}/{param2}', 'ApotekController@apiData');
        $router->get('settingppk/read/{param}', 'ApotekController@apiData');
        $router->get('spesialistik', 'ApotekController@apiData');
        $router->get('obat/{param1}/{param2}/{param3}', 'ApotekController@apiData');
    });

    // Obat Routes
    $router->post('obatnonracikan/v3/insert', 'ApotekController@apiData');
    $router->post('obatracikan/v3/insert', 'ApotekController@apiData');

    // Pelayanan Obat Routes
    $router->delete('pelayanan/obat/hapus', 'ApotekController@apiData');
    $router->get('obat/daftar/{param}', 'ApotekController@apiData');
    $router->get('riwayatobat/{param1}/{param2}/{param3}', 'ApotekController@apiData');
    
    // Resep Routes
    $router->post('sjpresep/v3/insert', 'ApotekController@apiData');
    $router->delete('hapusresep', 'ApotekController@apiData');
    $router->get('daftarresep', 'ApotekController@apiData');

    // SEP Routes
    $router->get('sep/{param}', 'ApotekController@apiData');

    // Monitoring Routes
    $router->group(['prefix' => 'monitoring'], function () use ($router) {
        $router->get('klaim/{param1}/{param2}/{param3}/{param4}', 'ApotekController@apiData');
    });
});