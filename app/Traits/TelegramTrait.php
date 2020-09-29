<?php

namespace App\Traits;

trait TelegramTrait{

    /**
     * Відправляє в телеграм повідомлення.
     * У файлі .env мають бути вказані параметри TELEGRAM_BOT_KEY, TELEGRAM_CHAT_UD
     * @param string $message
     * @return array
     */
    private function sendTelegram(string $message):array
    {
        $text = urlencode($message);
        $url = 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_KEY') .
            '/sendMessage?chat_id=@' . env('TELEGRAM_CHAT_ID') . '&text='.$text;
        return json_decode( file_get_contents($url), true);

    }
}
