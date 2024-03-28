<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class VClaimPesertaController extends Controller
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

    public function getNoKartu($param1, $param2, Request $request)
    {
        $param = array($param1, 'tglSEP', $param2);
        $response = $this->generalService->getDataV2($this->serviceName, 'Peserta/nokartu', $param, $request);

        return $response;
    }

    public function getNIK($param1, $param2, Request $request)
    {
        $param = array($param1, 'tglSEP', $param2);
        $response = $this->generalService->getDataV2($this->serviceName, 'Peserta/nik', $param, $request);

        return $response;
    }
}