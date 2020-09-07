<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ShortTrait;

class Shorts extends Model
{
    use ShortTrait;

    public function addNewShort(string $url, int $user_id = null){

        $user_id = ($user_id) ? $user_id : auth()->user()->id;

        $uniq = $this->isUniqShortFromUser($url, $user_id);

        if ($uniq){
            return $uniq->short_id;
        }

        $short_id = $this->generate_short_id();
        $this->url = $url;
        $this->short_id = $short_id;
        $this->user_id = $user_id;
        $this->linked = 0;
        $this->save();
        return $short_id;
    }

    /**
     * Перевіряє чи немає такого url для користувача
     * та повертає обєкт  якщо є.
     * @param $url string
     * @param $user_id int
     * @return mixed
     */
    public function isUniqShortFromUser(string $url, int $user_id){
        $whereArray = [
            ['url', '=', $url],
            ['user_id', '=', $user_id]
        ];
        return $this->where($whereArray)
                      ->first();;
    }

    /**
     * Поаертає ід звпису БД по слові скорочення
     * @param $short_id string
     * @return int - ід записч з таблички скорочень
     */
    public function getIdFromShortId(string $short_id):int {
        $res = $this->where('short_id', $short_id)->first();
        return (int)$res->id;
    }


}
