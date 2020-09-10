<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ShortTrait;
use Illuminate\Support\Facades\DB;

class Shorts extends Model
{
    use ShortTrait;

    public function addNewShort(string $url, int $user_id = null){

        $user_id = ($user_id) ? $user_id : auth()->user()->id;

        if ($this->isShorted($url)){
            return $this->getPathFromUrl($url);
        }

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
     * Перевіряє чи немає такого скорочення для користувача
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


    /**
     * Поаертає всі скорочення для всіх користувачав.
     * Використовувати лише для адмін панлі!
     * @return DB
     */
    public function getAllShortsFromAllUsers(){
        return DB::table('shorts')
                    ->leftJoin('users', 'shorts.user_id', '=', 'users.id')
                    ->select(
                        DB::raw('shorts.id as id, name, url, short_id, linked, shorts.updated_at as updated_at')
                    )
                    ->paginate(25);
    }

    /**
     * Повертає всі скорочення для користувача
     * @param $user_id int
     * @return mixed
     */
    public  function getAllShortFromUser(int $user_id = 0){
        $user_id = !$user_id ? (int)auth()->user()->id : $user_id;
        return DB::table('shorts')
            ->where('user_id', $user_id)
            ->all();
    }

}
