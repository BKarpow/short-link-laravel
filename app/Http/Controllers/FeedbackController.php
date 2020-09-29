<?php

namespace App\Http\Controllers;

use App\Traits\PhpMailTrait;
use App\Traits\TelegramTrait;
use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;
use App\Feedback;
use App\Mail\FeedbackMail;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    use PhpMailTrait;
    use TelegramTrait;

    function index(){
        return view('pages.feedback.index');
    }

    function send(FeedbackRequest $request){
        $Feedback = new Feedback();
        $name = $request->input('name');
        $title = $request->input('title', 'Empty title');
        $email = $request->input('email');
        $feedback = $request->input('feedback');
//        Mail::to($email)->send(new FeedbackMail($title, $feedback));
        $r = $this->setTo('bogdan.karpow@ukr.net')
                ->setSubject('Feedback '.$title)
            ->sendMail('Від '.$name."\r\n".$feedback);
        $rt = $this->sendTelegram('Від '.$name."\r\n".$feedback);
        $Feedback->saveFeedback($name, $title, $email, $feedback);
        return redirect()->route('feedback.index')->with('status', 'Відправлено!');
    }
}
