<?php

if (! function_exists('sendNotification')) {
    
    function sendNotification($content = '', $status = 200, array $headers = [])
    {
        return Notification::send($fcm_tokens = [], $message);
    }
}