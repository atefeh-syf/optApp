<?php


namespace App\Notifications\Helper\Strategy;

use App\Domains\User\Models\V1\User;

interface NotificationStrategy
{
    public function send($mobile, string $message);
}
