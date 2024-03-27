<?php

namespace App\Services;

use App\Helpers\AppHelper;
use App\Repositories\Settings\Provider\ProviderRepositoryInterface;
use LZCompressor\LZString;

class DecryptService
{
    public function __construct(
        ProviderRepositoryInterface $providerRepository
    )
    {
        $this->providerRepository = $providerRepository;
    }

    /**
     * Get all patients from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDecrypt($request)
    {
        // Validate the Request Header
        if(!$request->header('x-consid')) return AppHelper::response_json(null, 400, 'Consumer ID tidak boleh kosong.');
        if(!$request->header('x-conspwd')) return AppHelper::response_json(null, 400, 'Consumer Password tidak boleh kosong.');
        if(!$request->header('x-usersecret')) return AppHelper::response_json(null, 400, 'User Secret tidak boleh kosong.');

        // Declare Variable
        $encrypt_method = 'AES-256-CBC';
        $key = $request->header('x-consid') . $request->header('x-conspwd') . getdate()[0];
        $string = $request->header('x-usersecret');

        // Hash the Key
        $key_hash = hex2bin(hash('sha256', $key));
        $string_hash = base64_decode($string);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
        
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
        
        // Decompress using LZString
        $data = self::decompress($string);
        
        $response = [
            'key'           => $key,
            'data'          => $data,
        ];
    
        return AppHelper::response_json($response, 200, 'OK');
    }
    
    // LZ String Decompress
    function decompress($string){
        return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);
    }
}