<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class ApotekMonitoringController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GeneralService $generalService)
    {
        $this->generalService = $generalService;
        $this->serviceName = 'apotek-rest-dev';
    }

    public function getKlaim($param1, $param2, $param3, $param4, Request $request)
    {
        $param = array($param1, $param2, $param3, $param4);
        $response = $this->generalService->getDataV2($this->serviceName, 'monitoring/klaim', $param, $request);

        return $response;
    }
}