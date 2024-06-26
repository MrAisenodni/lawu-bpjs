<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class ApotekController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GeneralService $generalService)
    {
        $this->generalService   = $generalService;
    }

    public function apiData(Request $request)
    {
        $serviceName = str_replace('/apotek', '', parse_url($request->url())['path']);
        $url = env('BPJS_API_APOTEK').$serviceName;
        $response = $this->generalService->apiData($url, $request, $request->method(), $request->header('X-Content-Type'));

        return $response;
    }
}