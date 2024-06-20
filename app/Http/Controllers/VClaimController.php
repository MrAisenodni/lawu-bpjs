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

    public function apiData(Request $request)
    {
<<<<<<< HEAD
        $url = env('BPJS_API_VCLAIM');
=======
        $url = str_replace('20', '2.0', str_replace($this->hostName, $this->serviceName, $request->url()));
>>>>>>> 5596742e942744ddd6da4cc71442310dda2f7801
        $response = $this->generalService->apiData($url, $request, $request->method(), $request->header('X-Content-Type'));

        return $response;
    }
}