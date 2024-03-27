<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class AppHelper {

    public static function response_json($data = null, $code = 200, $message = 'Ok')
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
}