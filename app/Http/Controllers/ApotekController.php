<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class ApotekController extends Controller
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
        $this->hostName         = env('APP_URL').'/apotek';
    }

    public function apiData(Request $request)
    {
        $url = str_replace($this->hostName, $this->serviceName, $request->url());
        $response = $this->generalService->apiData($url, $request, $request->method());

        return $response;
    }
}