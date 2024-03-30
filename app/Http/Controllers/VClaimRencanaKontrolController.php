<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class VClaimRencanaKontrolController extends Controller
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
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/diagnosa', $param, $request, 'Application/x-www-form-urlencoded');

        return $response;
    }
}