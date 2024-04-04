<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class VClaimController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GeneralService $generalService)
    {
        $this->generalService   = $generalService;
        $this->serviceName      = 'vclaim-rest-dev';
        $this->hostName         = env('APP_URL').'/vclaim';
    }

    public function apiData(Request $request)
    {
        $url = str_replace('20', '2.0', str_replace($this->hostName, $this->serviceName, $request->url()));
        $response = $this->generalService->apiData($url, $request, $request->method(), $request->header('X-Content-Type'));

        return $response;
    }
}