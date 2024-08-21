<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use LZCompressor\LZString;

class AppHelper {
    public static function response_json($data = null, $code = 200, $message = 'OK')
    {
        $response = [
            'metadata' => [
                'message'   => $message,
                'code'      => $code,
            ],
            'response' => $data,
        ];

        if(!$data)
        {
            unset($response['response']);
        }
        
        return response()->json($response, $code);
    }

    public static function indo_day($index){
        $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        if(isset($days[$index])){
            return $days[$index];
        }

        return 'Jumat';
    }

    public static function api_encrypt($request, $timestamp, $url, $contentType, $method)
    {
        // Deklarasi Variabel 
        $consid             = $request->header('x-consid');
        $key                = $request->header('x-conspwd');
        $userkey            = $request->header('x-userkey');
        $data               = $request->header('x-consid')."&".$timestamp;
        $post               = json_encode($request->all());

        // Membuat Signature menggunakan HASH MAC: SHA256
        $signature          = hash_hmac('sha256', $data, $key, true);
        $encodedSignature   = base64_encode($signature);

        // Membentuk Parameter sebagai url
        $apiUrl = $url;

        // Jalankan CURL untuk mendapatkan Response dari BPJS
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HTTPHEADER => array(
                'x-cons-id: '.$consid,
                'x-timestamp: '.$timestamp,
                'x-signature: '.$encodedSignature,
                'user_key: '.$userkey,
                'Content-Type: '.$contentType,
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public static function get_decrypt($key, $string)
    {
        // Check String
        if (json_decode($string))
        {
            if (strlen(json_decode($string)->metaData->code) > 3) return self::response_json(null, 400, json_decode($string)->metaData->code);

            if (json_decode($string)->metaData->code == 200)
            {
                // Declare Variable
                $encrypt_method = 'AES-256-CBC';
                $string = json_decode($string)->response;
    
                // Hash the Key
                $key_hash = hex2bin(hash('sha256', $key));
                $string_hash = base64_decode($string);
                
                // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
                $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
                
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
                
                // Decompress Using LZ String
                $data = self::decompress($output);
                
                // Create Response
                $response = [
                    'key'           => $key,
                    'data'          => json_decode($data),
                ];
                return self::response_json($response, 200, 'OK');
            }

            // Create Response
            $response = [
                'key'           => $key,
                'data'          => null,
            ];
            return self::response_json($response, json_decode($string)->metaData->code, json_decode($string)->metaData->message);
        }
        return self::response_json(null, 400, $string);
    }

    public static function get_decrypt_antrean($key, $string)
    {
        // Check String
        if (json_decode($string))
        {
            if (strlen(json_decode($string)->metadata->code) > 3) return self::response_json(null, 400, json_decode($string)->metadata->code);

            if (json_decode($string)->metadata->code == 1)
            {
                // Declare Variable
                $encrypt_method = 'AES-256-CBC';
                $string = json_decode($string)->response;
    
                // Hash the Key
                $key_hash = hex2bin(hash('sha256', $key));
                $string_hash = base64_decode($string);
                
                // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
                $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
                
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
                
                // Decompress Using LZ String
                $data = self::decompress($output);
                
                // Create Response
                $response = [
                    'key'           => $key,
                    'data'          => json_decode($data),
                ];
                return self::response_json($response, 200, 'OK');
            }

            // Create Response
            $response = [
                'key'           => $key,
                'data'          => null,
            ];
            return self::response_json($response, json_decode($string)->metadata->code, json_decode($string)->metadata->message);
        }
        return self::response_json(null, 400, $string);
    }

    // LZ String Decompress
    public static function decompress($string){
        return LZString::decompressFromEncodedURIComponent($string);
    }
}