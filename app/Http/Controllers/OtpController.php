<?php

namespace App\Http\Controllers;

use App\Http\Requests\MobileVerifyRequest;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtpController extends Controller
{
    public function send(MobileVerifyRequest $request) {
        DB::beginTransaction();
        try {
            $otpService = new OtpService($request->mobile);
            $code = $otpService->createCode();
            $otpService->sendOTPCode($code);
            DB::commit();
            return response()->json([
                'message' => 'send otp  successful'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'send otp error'
            ], 422);
        }
    }

    public function verify(MobileVerifyRequest $request) {
        try {
            $otpService = new OtpService($request->mobile);
            if($otpService->verify($request->code)) {
                return response()->json([
                    'message' => 'verify otp successful'
                ], 200);
            }
            throw new \ErrorException('otp verify error');
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'otp verify error'
            ], 422);
        }
    }
}
