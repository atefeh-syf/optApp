<?php


namespace App\Notifications\Sms\Kavenagar\Services;


use App\Notifications\Helper\Strategy\NotificationStrategy;
use Kavenegar;

class NotificationBySms implements NotificationStrategy
{

    /**
     * @param $mobile
     * @param string $message
     */
    public function send($mobile, string $message)
    {
        try{
            $sender = env('KAVENEGAR_SENDER', 10004346);
            $receptor = [$mobile];
            $result = Kavenegar::Send($sender,$receptor,$message);
            if($result){
                foreach($result as $r){
                    echo "messageid = $r->messageid";
                    echo "message = $r->message";
                    echo "status = $r->status";
                    echo "statustext = $r->statustext";
                    echo "sender = $r->sender";
                    echo "receptor = $r->receptor";
                    echo "date = $r->date";
                    echo "cost = $r->cost";
                }
            }
        }
        catch(\Kavenegar\Exceptions\ApiException $e) {
            //echo $e->errorMessage();
            throw new \ErrorException('send send error');
        }
        catch(\Kavenegar\Exceptions\HttpException $e){
            throw new \ErrorException('connet to kavenagar service provider error');
            //echo $e->errorMessage();
        }
    }

}
