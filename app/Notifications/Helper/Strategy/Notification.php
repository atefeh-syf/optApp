<?php


namespace App\Notifications\Helper\Strategy;

class Notification
{
    private $notificationStrategy;

    public function __construct(NotificationStrategy $notificationStrategy)
    {
        $this->notificationStrategy = $notificationStrategy;
    }

    public function send(string $mobile, string $message)
    {
        return $this->notificationStrategy->send($mobile, $message);
    }
}
