<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class ApotekPelayananObatController extends Controller
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

    public function getDaftar($param, Request $request)
    {
        $param = array($param);
        $response = $this->generalService->getDataV2($this->serviceName, 'obat/daftar', $param, $request);

        return $response;
    }

    public function getRiwayat($param1, $param2, $param3, Request $request)
    {
        $param = array($param1, $param2, $param3);
        $response = $this->generalService->getDataV2($this->serviceName, 'riwayatobat', $param, $request);

        return $response;
    }
}