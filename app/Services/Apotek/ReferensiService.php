<?php

namespace App\Services\Apotek;

use App\Helpers\AppHelper;
use App\Repositories\Settings\Provider\ProviderRepositoryInterface;
use LZCompressor\LZString;

class ReferensiService
{
    public function __construct(
        ProviderRepositoryInterface $providerRepository
    )
    {
        $this->providerRepository = $providerRepository;
    }

    /**
     * Get All Data Apotek Referensi DPHO
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDpho($request)
    {
        // Validate the Request Header
        if(!$request->header('x-consid')) return AppHelper::response_json(null, 400, 'Consumer ID tidak boleh kosong.');
        if(!$request->header('x-conspwd')) return AppHelper::response_json(null, 400, 'Consumer Password tidak boleh kosong.');
        if(!$request->header('x-userkey')) return AppHelper::response_json(null, 400, 'User Secret tidak boleh kosong.');

        // Request Data to BPJS
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $response   = AppHelper::get_encrypt($request, $timestamp, 'apotek-rest-dev', 'referensi/dpho');

        // Declare Variable
        $key        = $request->header('x-consid') . $request->header('x-conspwd') . $timestamp;

        // Check Response
        if ($response)
        {
            $string = json_decode($response)->response;

            // Decrypt the Response from BPJS
            $json = AppHelper::get_decrypt($key, $string);

            return $json;
        }

        return AppHelper::response_json(null, 400, 'Terjadi Kesalahan pada Request.');
    }

    /**
     * Get All Data Apotek Referensi Poli
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPoli($param, $request)
    {
        // Validate the Request Header
        if(!$request->header('x-consid')) return AppHelper::response_json(null, 400, 'Consumer ID tidak boleh kosong.');
        if(!$request->header('x-conspwd')) return AppHelper::response_json(null, 400, 'Consumer Password tidak boleh kosong.');
        if(!$request->header('x-userkey')) return AppHelper::response_json(null, 400, 'User Secret tidak boleh kosong.');

        // Request Data to BPJS
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $response   = AppHelper::get_encrypt($request, $timestamp, 'apotek-rest-dev', 'referensi/poli', $param);

        // Create Key
        $key        = $request->header('x-consid') . $request->header('x-conspwd') . $timestamp;

        // Check Response
        if ($response)
        {
            $string = json_decode($response)->response;

            // Decrypt the Response from BPJS
            $json = AppHelper::get_decrypt($key, $string);

            return $json;
        }

        return AppHelper::response_json(null, 400, 'Terjadi Kesalahan pada Request.');
    }

    /**
     * Get All Data Apotek Referensi Setting PPK
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSetting($param, $request)
    {
        // Validate the Request Header
        if(!$request->header('x-consid')) return AppHelper::response_json(null, 400, 'Consumer ID tidak boleh kosong.');
        if(!$request->header('x-conspwd')) return AppHelper::response_json(null, 400, 'Consumer Password tidak boleh kosong.');
        if(!$request->header('x-userkey')) return AppHelper::response_json(null, 400, 'User Secret tidak boleh kosong.');

        // Request Data to BPJS
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $response   = AppHelper::get_encrypt($request, $timestamp, 'apotek-rest-dev', 'referensi/settingppk/read', $param);

        // Declare Variable
        $key        = $request->header('x-consid') . $request->header('x-conspwd') . $timestamp;

        // Check Response
        if ($response)
        {
            $string = json_decode($response)->response;

            // Decrypt the Response from BPJS
            $json = AppHelper::get_decrypt($key, $string);

            return $json;
        }

        return AppHelper::response_json(null, 400, 'Terjadi Kesalahan pada Request.');
    }

    /**
     * Get All Data Apotek Referensi Spesialistik
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSpesialistik($request)
    {
        // Validate the Request Header
        if(!$request->header('x-consid')) return AppHelper::response_json(null, 400, 'Consumer ID tidak boleh kosong.');
        if(!$request->header('x-conspwd')) return AppHelper::response_json(null, 400, 'Consumer Password tidak boleh kosong.');
        if(!$request->header('x-userkey')) return AppHelper::response_json(null, 400, 'User Secret tidak boleh kosong.');

        // Request Data to BPJS
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $response   = AppHelper::get_encrypt($request, $timestamp, 'apotek-rest-dev', 'referensi/spesialistik');

        // Declare Variable
        $key        = $request->header('x-consid') . $request->header('x-conspwd') . $timestamp;

        // Check Response
        if ($response)
        {
            $string = json_decode($response)->response;

            // Decrypt the Response from BPJS
            $json = AppHelper::get_decrypt($key, $string);

            return $json;
        }

        return AppHelper::response_json(null, 400, 'Terjadi Kesalahan pada Request.');
    }
}