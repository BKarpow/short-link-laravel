<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiTokenTrait;

class ApiToken extends Model
{
    use ApiTokenTrait;

    /**
     * Метод створює нового тоенгу для користувача
     * @return string токен для користувача
     */
    public function createToken():string{
        $token = $this->getUniqToken();
        $this->user_id = auth()->user()->id;
        $this->token = $token;
        $this->save();
        return $token;
    }

    /**
     * Перевіряє токен користувача
     * @param $token string
     * @return bool
     */
    public function isToken(string $token):bool{
        $tok = $this->where('token', $token)
            ->select('id')
            ->first();
        if (!$tok || !$tok->id) return false;
        else{
            if (!$this->isEnableToken($token)) return false;
            $this->incrementRequestsCount($token);
            return true;
        }
    }

    /**
     * Метод повертає ід користувача по його API токен
     * @param string $api_token - токен користувача
     * @return int $user_id - Ід користувача.
     */
    public function getUserIdFromApiToken(string $api_token):int
    {
        $user_id = $this
                    ->select('user_id')
                    ->where('token', $api_token)
                    ->first();
        if (!$user_id){
            return 0;
        }
        return (int)$user_id->user_id;
    }

    /**
     * Інкремує кількість використання токену
     * @param $token string,
     */
    public function incrementRequestsCount(string $token):void
    {
        $this->where('token', $token)->increment('request_count');
    }

    /**
     * Видаляє токен запис
     * @param $token string
     * @return void
     */
    public function deleteToken(string $token):void {
        $this->where('token', $token)->delete();
    }

    /**
     * Вмикає/вимикає токен
     * @param $token string
     *
     */
    public function toggleToken(string $token):void{
        $toggle = $this->where('token', $token)->first();
        $toggle->enable = !$toggle->enable;
        $toggle->save();
    }

    /**
     * Перевіряє увімкнений токен
     * @param $token string
     * @return bool
     */
    public function isEnableToken(string $token):bool {
        $enable = $this->where('token', $token)->first();
        return (bool)$enable->enable;
    }
}
