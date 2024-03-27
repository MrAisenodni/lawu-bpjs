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

    public function getPoli($id, Request $request)
    {
        $response = $this->referensiService->getPoli($id, $request);

        return $response;
    }
}
