<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class VClaimLPKController extends Controller
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

    public function getLembarPengajuanKlaim($param1, $param2, Request $request)
    {
        $param = array($param1, 'JnsPelayanan', $param2);
        $response = $this->generalService->getDataV2($this->serviceName, 'LPK/TglMasuk', $param, $request);

        return $response;
    }
}