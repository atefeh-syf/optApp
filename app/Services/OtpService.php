<?php

namespace App\Services;

use App\Repositories\OtpRepository;
use App\Models\OtpCode;
use Carbon\Carbon;
use App\Notifications\Helper\Strategy\Notification;
use App\Notifications\Sms\Kavenagar\Services\NotificationBySms;

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
        $otpCode = $this->otpRepository->checkExistCode();
        $code = $otpCode->code ?? '';
        return $code;
    }

    public function sendOTPCode($code) {
        (new Notification(new NotificationBySms()))->send($this->mobile, $code);
    }

    public function verify($code) {
        $otpCode = $this->otpRepository->checkCodeVerify($code);
        if($otpCode) {
            if($otpCode->expired_at < Carbon::now()) {
                return true;
            };
        }
        return false;
    }
}
