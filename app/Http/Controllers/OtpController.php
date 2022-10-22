<?php

namespace App\Http\Controllers;

use App\Http\Requests\MobileVerifyRequest;
use App\Http\Services\OtpService;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function send(MobileVerifyRequest $request) {
        try {
            $otpService = new OtpService($request->mobile);
            $code = $otpService->createCode();

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'otp send error'
            ], 422);
        }
    }
}
