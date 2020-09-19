<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendEmailController extends Controller
{
    public function send() {
        $comment = 'Это сообщение отправлено из формы обратной связи';
        $toEmail = "dexby101@gmail.com";
        Mail::to($toEmail)->send(new SendMail($comment));
        return 'Сообщение отправлено на адрес '. $toEmail;
    }
}
