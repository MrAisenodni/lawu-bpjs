<?php

namespace App\Http\Controllers;

use App\Services\GeneralService;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GeneralService $generalService)
    {
        $this->generalService = $generalService;
    }

    public function getData($serviceName, $url, Request $request)
    {
        $response = $this->generalService->getData($serviceName, $url, null, $request);

        return $response;
    }

    public function getByParam($serviceName, $url, $param, Request $request)
    {
        $response = $this->generalService->getData($serviceName, $url, $param, $request);

        return $response;
    }
}
