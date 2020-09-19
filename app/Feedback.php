<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ShortLogTrait;

class Feedback extends Model
{
    use ShortLogTrait;

    /**
     * Зберігає відгук в базі
     * @param string $name
     * @param string $title
     * @param string $email
     * @param string $feedback
     */
    public function saveFeedback(string $name, string $title, string $email, string $feedback):void
    {
        $this->name = $name;
        $this->title = $title;
        $this->email = $email;
        $this->feedback = $feedback;
        $this->ip = $this->getIp();
        $this->user_agent = $this->getUserAgent();
        $this->save();

    }
}
