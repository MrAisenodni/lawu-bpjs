<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class ApotekObatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GeneralService $generalService)
    {
        $this->generalService   = $generalService;
        $this->serviceName      = 'apotek-rest-dev';
    }

    public function postNonRacikan(Request $request)
    {
        $url = str_replace($this->serviceName, 'apotek', $request->url());
        dd($url, $request->url());
        $response = $this->generalService->postDataV2($this->serviceName, 'SEP/2.0/insert', null, $request, 'Application/x-www-form-urlencoded');

        return $response;
    }
}