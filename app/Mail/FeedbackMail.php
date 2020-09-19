<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $title;
    public string $feedback;
    /**
     * Create a new message instance.
     * @param string $title
     * @param string $feedback
     * @return void
     */
    public function __construct(string $title, string $feedback)
    {
        $this->title = $title;
        $this->feedback = $feedback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.feedback');
    }
}
