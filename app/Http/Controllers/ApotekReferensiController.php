<?php

namespace App\Http\Controllers;

use App\Services\Apotek\ReferensiService;
use Illuminate\Http\Request;

class ApotekReferensiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ReferensiService $referensiService)
    {
        $this->referensiService = $referensiService;
    }

    public function getDpho(Request $request)
    {
        $response = $this->referensiService->getDpho($request);

        return $response;
    }

    public function getPoli($param, Request $request)
    {
        $response = $this->referensiService->getPoli($param, $request);

        return $response;
    }

    public function getSetting($param, Request $request)
    {
        $response = $this->referensiService->getSetting($param, $request);

        return $response;
    }

    public function getSpesialistik(Request $request)
    {
        $response = $this->referensiService->getSpesialistik($request);

        return $response;
    }
}
