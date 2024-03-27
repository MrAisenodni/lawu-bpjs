<?php

namespace App\Services;

use App\Helpers\AppHelper;
use App\Repositories\Settings\Provider\ProviderRepositoryInterface;
use LZCompressor\LZString;

class SignatureService
{
    public function __construct(
        ProviderRepositoryInterface $providerRepository
    )
    {
        $this->providerRepository = $providerRepository;
    }

    /**
     * Decrypt the requests from BPJS
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDecrypt($request)
    {
        // Validate the Request Header
        if(!$request->header('x-consid')) return AppHelper::response_json(null, 400, 'Consumer ID tidak boleh kosong.');
        if(!$request->header('x-conspwd')) return AppHelper::response_json(null, 400, 'Consumer Password tidak boleh kosong.');
        if(!$request->header('x-userkey')) return AppHelper::response_json(null, 400, 'User Secret tidak boleh kosong.');

        // Request Data to BPJS
        $response = AppHelper::get_reques($request, 'apotek-rest-dev', 'referensi/dpho');

        // Declare Variable
        $key = $request->header('x-consid') . $request->header('x-conspwd') . $timestamp;
        $string = json_decode($response)->response;

        // Decrypt the Response from BPJS
        $json = AppHelper::get_decrypt($key, $string);

        return $json;
    }

    /**
     * Encrypt the request posted to BPJS
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getEncrypt($request)
    {
        date_default_timezone_set('UTC');

        // Validate the Request Header
        if(!$request->header('x-consid')) return AppHelper::response_json(null, 400, 'Consumer ID tidak boleh kosong.');
        if(!$request->header('x-conspwd')) return AppHelper::response_json(null, 400, 'Consumer Password tidak boleh kosong.');
        if(!$request->header('x-userkey')) return AppHelper::response_json(null, 400, 'User Secret tidak boleh kosong.');

        // Declare Variable
        $timestamp          = strtotime(date("Y-m-d H:i:s"));
        $key                = $request->header('x-conspwd');
        $data               = $request->header('x-consid')."&".strtotime(date("Y-m-d H:i:s"));
        $signature          = hash_hmac('sha256', $data, $key, true);
        $encodedSignature   = base64_encode($signature);
        
        // Create Response
        $response = [
            'x-consid'      => $request->header('x-consid'),
            'x-timestamp'   => $timestamp,
            'x-signature'   => $encodedSignature,
            'user_key'      => $request->header('x-userkey'),
        ];
    
        return AppHelper::response_json($response, 200, 'OK');
    }
}