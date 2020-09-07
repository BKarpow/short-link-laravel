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
}
