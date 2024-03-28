<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class VClaimPRBController extends Controller
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

    public function getNoSRB($param1, $param2, Request $request)
    {
        $param = array($param1, 'nosep', $param2);
        $response = $this->generalService->getDataV2($this->serviceName, 'prb', $param, $request);

        return $response;
    }

    public function getTglSRB($param1, $param2, Request $request)
    {
        $param = array('tglMulai', $param1, 'tglAkhir', $param2);
        $response = $this->generalService->getDataV2($this->serviceName, 'prb', $param, $request);

        return $response;
    }
}