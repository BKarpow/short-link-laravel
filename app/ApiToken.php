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
}
