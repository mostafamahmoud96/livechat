<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Notification;

class NotificationController extends Controller
{
    private $notification;

    public function __construct(Notification $notification) {
        $this->notification = $notification;
    }

    public function send(Request $request) {
        $this->notification->send();
    }
}
