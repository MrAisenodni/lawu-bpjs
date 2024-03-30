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
$router->group(['prefix' => 'vclaim'], function () use ($router) {
    // LPK Routes
    $router->group(['prefix' => 'LPK'], function () use ($router) {
        $router->get('TglMasuk/{param1}/JnsPelayanan/{param2}', 'VClaimLPKController@getLembarPengajuanKlaim');
    });

    // Monitoring Routes
    $router->group(['prefix' => 'Monitoring'], function () use ($router) {
        $router->get('Kunjungan/Tanggal/{param1}/JnsPelayanan/{param2}', 'VClaimMonitoringController@getKunjungan');
        $router->get('Klaim/Tanggal/{param1}/JnsPelayanan/{param2}/Status/{param3}', 'VClaimMonitoringController@getKlaim');
        $router->get('HistoriPelayanan/NoKartu/{param1}/tglMulai/{param2}/tglAkhir/{param3}', 'VClaimMonitoringController@getHistoriPelayanPeserta');
        $router->get('JasaRaharja/JnsPelayanan/{param1}/tglMulai/{param2}/tglAkhir/{param3}', 'VClaimMonitoringController@getKlaimJaminanJasaRaharja');
    });

    // Peserta Routes
    $router->group(['prefix' => 'Peserta'], function () use ($router) {
        $router->get('nokartu/{param1}/tglSEP/{param2}', 'VClaimPesertaController@getNoKartu');
        $router->get('nik/{param1}/tglSEP/{param2}', 'VClaimPesertaController@getNIK');
    });

    // PRB Routes
    $router->group(['prefix' => 'prb'], function () use ($router) {
        $router->get('{param1}/nosep/{param2}', 'VClaimPRBController@getNoSRB');
        $router->get('tglMulai/{param1}/tglAkhir/{param2}', 'VClaimPRBController@getTglSRB');
    });

    // Referensi Routes
    $router->group(['prefix' => 'referensi'], function () use ($router) {
        $router->get('diagnosa/{param}', 'VClaimReferensiController@getDiagnosa');
        $router->get('poli/{param}', 'VClaimReferensiController@getPoli');
        $router->get('faskes/{param1}/{param2}', 'VClaimReferensiController@getFaskes');
        $router->get('dokter/pelayanan/{param1}/tglPelayanan/{param2}/Spesialis/{param3}', 'VClaimReferensiController@getDokterPelayanan');
        $router->get('propinsi', 'VClaimReferensiController@getPropinsi');
        $router->get('kabupaten/propinsi/{param}', 'VClaimReferensiController@getKabupaten');
        $router->get('kecamatan/kabupaten/{param}', 'VClaimReferensiController@getKecamatan');
        $router->get('diagnosaprb', 'VClaimReferensiController@getDiagnosaPRB');
        $router->get('obatprb/{param}', 'VClaimReferensiController@getObatPRB');
        $router->get('procedure/{param}', 'VClaimReferensiController@getProcedure');
        $router->get('kelasrawat', 'VClaimReferensiController@getKelasRawat');
        $router->get('dokter', 'VClaimReferensiController@getDokter');
        $router->get('spesialistik', 'VClaimReferensiController@getSpesialistik');
        $router->get('ruangrawat', 'VClaimReferensiController@getRuangRawat');
        $router->get('carakeluar', 'VClaimReferensiController@getCaraKeluar');
        $router->get('pascapulang', 'VClaimReferensiController@getPascaPulang');
    });

    // Rencana Kontrol Routes
    $router->group(['prefix' => 'RencanaKontrol'], function () use ($router) {
        $router->get('nosep/{param}', 'VClaimRencanaKontrolController@getCariSEP');
        $router->get('noSuratKontrol/{param}', 'VClaimRencanaKontrolController@getCariNoSuratKontrol');
    });
});

// Apotek Routes
$router->group(['prefix' => 'apotek'], function () use ($router) {
    // Referensi Routes
    $router->group(['prefix' => 'referensi'], function () use ($router) {
        $router->get('dpho', 'ApotekReferensiController@getDpho');
        $router->get('poli/{param}', 'ApotekReferensiController@getPoli');
        $router->get('ppk/{param1}/{param2}', 'ApotekReferensiController@getFasilitasKesehatan');
        $router->get('setting/{param}', 'ApotekReferensiController@getSetting');
        $router->get('spesialistik', 'ApotekReferensiController@getSpesialistik');
        $router->get('obat/{param1}/{param2}/{param3}', 'ApotekReferensiController@getObat');
    });

    // Pelayanan Obat Routes
    $router->group(['prefix' => 'pelayanan-obat'], function () use ($router) {
        $router->get('daftar/{param}', 'ApotekPelayananObatController@getDaftar');
        $router->get('riwayatobat/{param1}/{param2}/{param3}', 'ApotekPelayananObatController@getRiwayat');
    });

    // SEP Routes
    $router->get('sep/{param}', 'ApotekSepController@getSep');

    // Monitoring Routes
    $router->group(['prefix' => 'monitoring'], function () use ($router) {
        $router->get('klaim/{param1}/{param2}/{param3}/{param4}', 'ApotekMonitoringController@getKlaim');
    });
});