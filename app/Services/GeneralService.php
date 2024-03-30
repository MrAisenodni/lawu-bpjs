<?php

namespace App\Services;

use App\Helpers\AppHelper;
use LZCompressor\LZString;

class GeneralService
{
    /**
     * Decrypt the requests from BPJS
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getData($serviceName, $url, $param, $request)
    {
        // Validate the Request Header
        if(!$request->header('x-consid')) return AppHelper::response_json(null, 400, 'Consumer ID tidak boleh kosong.');
        if(!$request->header('x-conspwd')) return AppHelper::response_json(null, 400, 'Consumer Password tidak boleh kosong.');
        if(!$request->header('x-userkey')) return AppHelper::response_json(null, 400, 'User Secret tidak boleh kosong.');

        // Declare Variable
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $key        = $request->header('x-consid') . $request->header('x-conspwd') . $timestamp;
        $url        = str_replace('|', '/', $url);
        ($param) ? $param = explode('|', $param) : $param;
        ($param) ? $count = count($param) : $count = 0;

        // Request Data to BPJS
        ($param) 
            ? $response = AppHelper::get_encrypt($request, $timestamp, $serviceName, $url, $param, $count)
            : $response = AppHelper::get_encrypt($request, $timestamp, $serviceName, $url);

        // Decrypt the Response from BPJS
        $string = $response;
        $json   = AppHelper::get_decrypt($key, $string);

        return $json;
    }

    /**
     * Get All Data Apotek Referensi Setting PPK
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDataV2($serviceName, $url, $param, $request, $contentType = 'application/json; charset=utf-8')
    {
        // Validate the Request Header
        if(!$request->header('x-consid')) return AppHelper::response_json(null, 400, 'Consumer ID tidak boleh kosong.');
        if(!$request->header('x-conspwd')) return AppHelper::response_json(null, 400, 'Consumer Password tidak boleh kosong.');
        if(!$request->header('x-userkey')) return AppHelper::response_json(null, 400, 'User Secret tidak boleh kosong.');

        // Declare Variable
        $timestamp  = strtotime(date("Y-m-d H:i:s"));
        $key        = $request->header('x-consid') . $request->header('x-conspwd') . $timestamp;
        ($param) ? $count = count($param) : $count = 0;

        // Request Data to BPJS
        ($param) 
            ? $response = AppHelper::get_encrypt($request, $timestamp, $serviceName, $url, $param, $count, $contentType)
            : $response = AppHelper::get_encrypt($request, $timestamp, $serviceName, $url, null, 0, $contentType);

        // Decrypt the Response from BPJS
        $string = $response;
        $json   = AppHelper::get_decrypt($key, $string);

        return $json;
    }
}