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
        $string = json_decode($response)->response;
        $json = AppHelper::get_decrypt($key, $string);

        return $json;
    }
}