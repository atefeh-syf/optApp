<?php

namespace App\Repositories;

use App\Models\OtpCode;
use Carbon\Carbon;

class OtpRepository
{
    public $mobile;
    public function __construct($mobile)
    {
        $this->mobile = $mobile;
    }

    public function createCode() {
        $code = rand(10000, 999999);
        $otp = new OtpCode();
        $otp->mobile = $this->mobile;
        $otp->code = $code;
        if(!$otp->save()) {

        }
        return $code;
    }

    public function checkExistCode() {
        $code = OtpCode::where('mobile', $this->mobile)
                        ->whereNull('used_at')
                        ->where('created_at', '>=', Carbon::now()->addMinutes(-3))->first();

        return $code;
    }
}
