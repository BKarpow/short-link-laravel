<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;
use App\Feedback;
use App\Mail\FeedbackMail;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    function index(){
        return view('pages.feedback.index');
    }

    function send(FeedbackRequest $request){
        $Feedback = new Feedback();
        $name = $request->input('name');
        $title = $request->input('title', 'Empty title');
        $email = $request->input('email');
        $feedback = $request->input('feedback');
        Mail::to($email)->send(new FeedbackMail($title, $feedback));
        $Feedback->saveFeedback($name, $title, $email, $feedback);
        return redirect()->route('feedback.index')->with('status', 'Відправлено!');
    }
}
