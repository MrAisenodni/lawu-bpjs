<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class VClaimController extends Controller
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

    public function apiData(Request $request, $serviceName)
    {
        // Ubah URL dari 20 ke 2.0
        $serviceName = str_replace('20', '2.0', $serviceName);

        // Ubah URL dari 10 ke 1.0
        $serviceName = str_replace('10', '2.0', $serviceName);

        // Ubah URL sesuai ketentuan BPJS
        $serviceName = str_replace('/vclaim', '', parse_url($request->url())['path']);

        // Mengambil Response dari BPJS
        $url = env('BPJS_API_VCLAIM').$serviceName;
        $response = $this->generalService->apiData($url, $request, $request->method(), $request->header('X-Content-Type'));

        return $response;
    }
}