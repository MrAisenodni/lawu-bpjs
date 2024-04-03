<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class VClaimSEPController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GeneralService $generalService)
    {
        $this->generalService = $generalService;
        $this->serviceName = 'vclaim-rest-dev';
    }

    public function getCariSEP($param, Request $request)
    {
        $param = array($param);
        $response = $this->generalService->getDataV2($this->serviceName, 'SEP', $param, $request, 'Application/x-www-form-urlencoded');

        return $response;
    }
    
    public function insertSEP2(Request $request)
    {
        $response = $this->generalService->postDataV2($this->serviceName, 'SEP/2.0/insert', null, $request, 'Application/x-www-form-urlencoded');

        return $response;
    }
}