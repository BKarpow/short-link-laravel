<?php

namespace  App\Traits;

trait ApiTokenTrait{

    /**
     * Сіль для токенів
     * @type string
     */
    private string $token_salt = 'ertg!f$y56y4gd$%^fgdht';

    /**
     * Генерує новий токен
     * @retyrn string - ТОКЕН
     */
    private function generate_token():string{
        auth()->check() || abort(404);
        $email = auth()->user()->email;
        return sha1(md5($email) . md5($this->token_salt));
    }

    /**
     * Отримує унікальний токен
     * @return string
     */
    protected function getUniqToken():string{
        $random_func = function_exists('mt_rand') ? 'mt_rand' : 'rand';
        $token = $this->generate_token();
        if ($this->where('token', $token)->first()){
            $this->token_salt .= (string)$random_func(0, 1000);
            return $this->generate_token();
        }
        return $token;
    }
}
