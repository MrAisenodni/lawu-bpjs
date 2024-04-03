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

// Apotek Routes
$router->group(['prefix' => 'vclaim'], function () use ($router) {
    // LPK Routes
    $router->group(['prefix' => 'LPK'], function () use ($router) {
        $router->post('insert', 'VClaimController@apiData');
        $router->put('update', 'VClaimController@apiData');
        $router->delete('delete', 'VClaimController@apiData');
        $router->get('TglMasuk/{param1}/JnsPelayanan/{param2}', 'VClaimController@apiData');
    });

    // Monitoring Routes
    $router->group(['prefix' => 'Monitoring'], function () use ($router) {
        $router->get('Kunjungan/Tanggal/{param1}/JnsPelayanan/{param2}', 'VClaimController@apiData');
        $router->get('Klaim/Tanggal/{param1}/JnsPelayanan/{param2}/Status/{param3}', 'VClaimController@apiData');
        $router->get('HistoriPelayanan/NoKartu/{param1}/tglMulai/{param2}/tglAkhir/{param3}', 'VClaimController@apiData');
        $router->get('JasaRaharja/JnsPelayanan/{param1}/tglMulai/{param2}/tglAkhir/{param3}', 'VClaimController@apiData');
    });

    // Peserta Routes
    $router->group(['prefix' => 'Peserta'], function () use ($router) {
        $router->get('nokartu/{param1}/tglSEP/{param2}', 'VClaimController@apiData');
        $router->get('nik/{param1}/tglSEP/{param2}', 'VClaimController@apiData');
    });

    // PRB Routes
    $router->group(['prefix' => 'PRB'], function () use ($router) {
        $router->post('insert', 'VClaimController@apiData');
        $router->put('update', 'VClaimController@apiData');
        $router->delete('delete', 'VClaimController@apiData');
    });
    $router->group(['prefix' => 'prb'], function () use ($router) {
        $router->get('{param1}/nosep/{param2}', 'VClaimController@apiData');
        $router->get('tglMulai/{param1}/tglAkhir/{param2}', 'VClaimController@apiData');
    });

    // Referensi Routes
    $router->group(['prefix' => 'referensi'], function () use ($router) {
        $router->get('diagnosa/{param}', 'VClaimController@apiData');
        $router->get('poli/{param}', 'VClaimController@apiData');
        $router->get('faskes/{param1}/{param2}', 'VClaimController@apiData');
        $router->get('dokter/pelayanan/{param1}/tglPelayanan/{param2}/Spesialis/{param3}', 'VClaimController@apiData');
        $router->get('propinsi', 'VClaimController@apiData');
        $router->get('kabupaten/propinsi/{param}', 'VClaimController@apiData');
        $router->get('kecamatan/kabupaten/{param}', 'VClaimController@apiData');
        $router->get('diagnosaprb', 'VClaimController@apiData');
        $router->get('obatprb/{param}', 'VClaimController@apiData');
        $router->get('procedure/{param}', 'VClaimController@apiData');
        $router->get('kelasrawat', 'VClaimController@apiData');
        $router->get('dokter', 'VClaimController@apiData');
        $router->get('spesialistik', 'VClaimController@apiData');
        $router->get('ruangrawat', 'VClaimController@apiData');
        $router->get('carakeluar', 'VClaimController@apiData');
        $router->get('pascapulang', 'VClaimController@apiData');
    });

    // Rencana Kontrol Routes
    $router->group(['prefix' => 'RencanaKontrol'], function () use ($router) {
        $router->post('insert', 'VClaimController@apiData');
        $router->put('update', 'VClaimController@apiData');
        $router->delete('delete', 'VClaimController@apiData');
        $router->post('InsertSPRI', 'VClaimController@apiData');
        $router->put('UpdateSPRI', 'VClaimController@apiData');
        $router->get('nosep/{param}', 'VClaimController@apiData');
        $router->get('noSuratKontrol/{param}', 'VClaimController@apiData');
        $router->get('ListRencanaKontrol/Bulan/{param1}/Tahun/{param2}/Nokartu/{param3}/filter/{param4}', 'VClaimController@apiData');
        $router->get('ListRencanaKontrol/tglAwal/{param1}/tglAkhir/{param2}/filter/{param3}', 'VClaimController@apiData');
        $router->get('JadwalPraktekDokter/JnsKontrol/{param1}/KdPoli/{param2}/TglRencanaKontrol/{param3}', 'VClaimController@apiData');
    });

    // Rujukan Routes
    $router->group(['prefix' => 'Rujukan'], function () use ($router) {
        $router->get('{param}', 'VClaimController@apiData');
        $router->get('RS/{param}', 'VClaimController@apiData');
        $router->get('Peserta/{param}', 'VClaimController@apiData');
        $router->get('RS/Peserta/{param}', 'VClaimController@apiData');
        $router->get('List/Peserta/{param}', 'VClaimController@apiData');
        $router->get('RS/List/Peserta/{param}', 'VClaimController@apiData');
        $router->post('insert', 'VClaimController@apiData');
        $router->put('update', 'VClaimController@apiData');
        $router->delete('delete', 'VClaimController@apiData');

        // Rujukan Khusus Routes
        $router->group(['prefix' => 'Khusus'], function () use ($router) {
            $router->post('insert', 'VClaimController@apiData');
            $router->delete('delete', 'VClaimController@apiData');
            $router->delete('List/Bulan/{param1}/Tahun/{param2}', 'VClaimController@apiData');
        });

        $router->post('20/insert', 'VClaimController@apiData');
        $router->put('20/update', 'VClaimController@apiData');
        $router->get('ListSpesialistik/PPKRujukan/{param1}/TglRujukan/{param2}', 'VClaimController@apiData');
        $router->get('ListSarana/PPKRujukan/{param1}', 'VClaimController@apiData');
        $router->get('Keluar/List/tglMulai/{param1}/tglAkhir/{param2}', 'VClaimController@apiData');
        $router->get('Keluar/{param1}', 'VClaimController@apiData');
        $router->get('JumlahSEP/{param1}/{param2}', 'VClaimController@apiData');
    });

    // SEP Routes
    $router->group(['prefix' => 'SEP'], function () use ($router) {
        // Pembuatan SEP Routes
        $router->post('11/insert', 'VClaimController@apiData');
        $router->put('11/update', 'VClaimController@apiData');
        $router->delete('11/delete', 'VClaimController@apiData');
        $router->get('{param}', 'VClaimController@apiData');
        $router->post('20/insert', 'VClaimController@apiData');
        $router->put('20/update', 'VClaimController@apiData');
        $router->delete('20/delete', 'VClaimController@apiData');
        
        // SEP Internal Routes
        $router->group(['prefix' => 'Internal'], function () use ($router) {
            $router->get('{param1}', 'VClaimController@apiData');
            $router->delete('delete', 'VClaimController@apiData');
        });

        // Finger Print Routes
        $router->group(['prefix' => 'FingerPrint'], function () use ($router) {
            $router->get('Peserta/{param1}/TglPelayanan/{param2}', 'VClaimController@apiData');
            $router->get('List/Peserta/TglPelayanan/{param}', 'VClaimController@apiData');

            // Random Question Routes
            $router->get('randomquestion/faskesterdaftar/nokapst/{param1}/tglsep/{param2}', 'VClaimController@apiData');
            $router->post('randomanswer', 'VClaimController@apiData');
        });
    });
    $router->group(['prefix' => 'sep'], function () use ($router) {
        // Potensi Suplesi Jasa Raharja Routes
        $router->get('JasaRaharja/Suplesi/{param1}/tglPelayanan/{param2}', 'VClaimController@apiData');
        $router->get('KllInduk/List/{param1}', 'VClaimController@apiData');

        // Integrasi SEP dan Inacbg Routes
        $router->get('cbg/{param}', 'VClaimController@apiData');
    });
    $router->group(['prefix' => 'Sep'], function () use ($router) {
        // Approval Penjaminan SEP Routes
        $router->post('pengajuanSEP', 'VClaimController@apiData');
        $router->post('aprovalSEP', 'VClaimController@apiData');
        $router->get('persetujuanSEP/list/bulan/{param1}/tahun/{param2}', 'VClaimController@apiData');

        // Update Tgl Pulang SEP Routes
        $router->put('updtglplg', 'VClaimController@apiData');
        $router->put('20/updtglplg', 'VClaimController@apiData');
        $router->get('updtglplg/list/bulan/{param1}/tahun/{param2}/{param3}', 'VClaimController@apiData');
    });
});

// Apotek Routes
$router->group(['prefix' => 'apotek'], function () use ($router) {
    // Referensi Routes
    $router->group(['prefix' => 'referensi'], function () use ($router) {
        $router->get('dpho', 'ApotekReferensiController@apiData');
        $router->get('poli/{param}', 'ApotekReferensiController@apiData');
        $router->get('ppk/{param1}/{param2}', 'ApotekReferensiController@apiData');
        $router->get('settingppk/read/{param}', 'ApotekReferensiController@apiData');
        $router->get('spesialistik', 'ApotekReferensiController@apiData');
        $router->get('obat/{param1}/{param2}/{param3}', 'ApotekReferensiController@apiData');
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