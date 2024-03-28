<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class VClaimReferensiController extends Controller
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

    public function getDiagnosa($param, Request $request)
    {
        $param = array($param);
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/diagnosa', $param, $request);

        return $response;
    }

    public function getPoli($param, Request $request)
    {
        $param = array($param);
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/poli', $param, $request);

        return $response;
    }

    public function getFaskes($param1, $param2, Request $request)
    {
        $param = array($param1, $param2);
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/faskes', $param, $request);

        return $response;
    }

    public function getDokterPelayanan($param1, $param2, $param3, Request $request)
    {
        $param = array($param1, 'tglPelayanan', $param2, 'Spesialis', $param3);
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/dokter/pelayanan', $param, $request);

        return $response;
    }

    public function getPropinsi(Request $request)
    {
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/propinsi', null, $request);

        return $response;
    }

    public function geKabupaten($param, Request $request)
    {
        $param = array($param);
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/kabupaten/propinsi', $param, $request);

        return $response;
    }

    public function geKecamatan($param, Request $request)
    {
        $param = array($param);
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/kecamatan/kabupaten', $param, $request);

        return $response;
    }

    public function getDiagnosaPRB(Request $request)
    {
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/diagnosaprb', null, $request);

        return $response;
    }

    public function getObatPRB($param, Request $request)
    {
        $param = array($param);
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/obatprb', $param, $request);

        return $response;
    }

    public function getProcedure($param, Request $request)
    {
        $param = array($param);
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/procedure', $param, $request);

        return $response;
    }

    public function getKelasRawat(Request $request)
    {
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/kelasrawat', null, $request);

        return $response;
    }

    public function getDokter($param, Request $request)
    {
        $param = array($param);
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/dokter', $param, $request);

        return $response;
    }

    public function getSpesialistik(Request $request)
    {
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/spesialistik', null, $request);

        return $response;
    }

    public function getCaraKeluar(Request $request)
    {
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/carakeluar', null, $request);

        return $response;
    }

    public function getPascaPulang(Request $request)
    {
        $response = $this->generalService->getDataV2($this->serviceName, 'referensi/pascapulang', null, $request);

        return $response;
    }
}