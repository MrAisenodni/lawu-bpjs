<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class ApotekReferensiController extends Controller
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

    public function getDpho(Request $request)
    {
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/dpho', null, $request);

        return $response;
    }

    public function getPoli($param, Request $request)
    {
        $param = array($param);
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/poli', $param, $request);

        return $response;
    }

    public function getFasilitasKesehatan($param1, $param2, Request $request)
    {
        $param = array($param1, $param2);
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/ppk', $param, $request);

        return $response;
    }

    public function getSetting($param, Request $request)
    {
        $param = array($param);
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/settingppk/read', $param, $request);

        return $response;
    }

    public function getSpesialistik(Request $request)
    {
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/spesialistik', null, $request);

        return $response;
    }

    public function getObat($param1, $param2, $param3, Request $request)
    {
        $param = array($param1, $param2, $param3);
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/ppk', $param, $request);

        return $response;
    }
}