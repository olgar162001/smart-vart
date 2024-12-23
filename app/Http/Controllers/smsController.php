<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class smsController extends Controller
{

    public function send_sms(){
        $basic  = new \Vonage\Client\Credentials\Basic("d5bc8aba", "QQK3uHNNpKh0z6RN");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("255623088187", env('APP_NAME'), 'A text message sent using the Nexmo SMS API')
        );
        
        $message = $response->current();
        
        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
    }

}
