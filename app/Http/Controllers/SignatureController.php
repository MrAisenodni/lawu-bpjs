<?php

namespace App\Http\Controllers;

use App\Services\SignatureService;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SignatureService $signatureService)
    {
        $this->signatureService = $signatureService;
    }

    public function getDecrypt(Request $request)
    {
        $response = $this->signatureService->getDecrypt($request);

        return $response;
    }

    public function getEncrypt(Request $request)
    {
        $response = $this->signatureService->getEncrypt($request);

        return $response;
    }
}
