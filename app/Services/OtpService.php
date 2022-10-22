<?php

namespace App\Http\Services;

use App\Models\OtpCode;
use Carbon\Carbon;

class OtpService
{
    public $mobile;
    public $otpRepository;

    public function __construct($mobile)
    {
        $this->mobile = $mobile;
        $this->otpRepository = new OtpRepository($mobile);
    }

    public function createCode() {
        $code = $this->checkExistCode();
        if(!$code) {
            $code = $this->otpRepository->createCode();
        }
        return $code;
    }

    public function checkExistCode() {
        $code = $this->otpRepository->checkExistCode();
        return $code;
    }
}
