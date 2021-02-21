<?php

namespace App\Classes;
use App\Models\User;

class Notification {

    public static function send($fcm_tokens = [], $message) {

        $SERVER_API_KEY = 'AAAAUyMsf5o:APA91bESJLSyDnb50jKJ7V6NA9ojkboCb_Q31mQoS3FbjS2Maed4F0GfHSX9SGj-aN0SpG9rHJxKfW14XCCZIw1reyXfEM032KdZnx8ZNc5pBLZFq80WNG7qbQ_f8uK7ShSYy92PKQeI';
  
        $data = [
            "registration_ids" => $fcm_tokens,
            "notification" => [
                "title" => "New Message Received",
                "body" => $message,  
            ]
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);

    }

} // cust supp chat app  firebase send 