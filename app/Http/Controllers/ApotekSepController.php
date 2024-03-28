<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class ApotekSepController extends Controller
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

    public function getSep($param, Request $request)
    {
        $param = array($param);
        $response = $this->generalService->getDataV2($this->serviceName, 'sep', $param, $request);

        return $response;
    }
}