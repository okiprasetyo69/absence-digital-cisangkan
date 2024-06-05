<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send_mail(){
        Mail::to('oki.prasetyo45@gmail.com')->send(new EmailNotification);
        echo "Success send email notification. Check your inbox";
    }
}
