<?php

namespace App\Http\Controllers;

use App\Services\DecryptService;
use Illuminate\Http\Request;

class DecryptController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DecryptService $decryptService)
    {
        $this->decryptService = $decryptService;
    }

    public function getDecrypt(Request $request)
    {
        $response = $this->decryptService->getDecrypt($request);

        return $response;
    }
}
