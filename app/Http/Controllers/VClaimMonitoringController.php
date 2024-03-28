<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class VClaimMonitoringController extends Controller
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

    public function getKunjungan($param1, $param2, Request $request)
    {
        $param = array($param1, 'JnsPelayanan', $param2);
        $response = $this->generalService->getDataV2($this->serviceName, 'Monitoring/Kunjungan/Tanggal', $param, $request);

        return $response;
    }

    public function getKlaim($param1, $param2, $param3, Request $request)
    {
        $param = array($param1, 'JnsPelayanan', $param2, 'Status', $param3);
        $response = $this->generalService->getDataV2($this->serviceName, 'Monitoring/Klaim/Tanggal', $param, $request);

        return $response;
    }

    public function getHistoriPelayanPeserta($param1, $param2, $param3, Request $request)
    {
        $param = array($param1, 'tglMulai', $param2, 'tglAkhir', $param3);
        $response = $this->generalService->getDataV2($this->serviceName, 'monitoring/HistoriPelayanan/NoKartu', $param, $request);

        return $response;
    }

    public function getKlaimJaminanJasaRaharja($param1, $param2, $param3, Request $request)
    {
        $param = array($param1, 'tglMulai', $param2, 'tglAkhir', $param3);
        $response = $this->generalService->getDataV2($this->serviceName, 'monitoring/JasaRaharja/JnsPelayanan', $param, $request);

        return $response;
    }
}