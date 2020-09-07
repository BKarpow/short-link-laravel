<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ShortTrait;

class Shorts extends Model
{
    use ShortTrait;

    public function addNewShort(string $url, int $user_id = null){
        $short_id = $this->generate_short_id();
        $this->url = $url;
        $this->short_id = $short_id;
        $this->user_id = ($user_id) ? $user_id : auth()->user()->id;
        $this->linked = 0;
        $this->save();
        return $short_id;
    }

    /**
     * Поаертає ід звпису БД по слові скорочення
     * @params string - хеш скорочення
     * @return int - ід записч з таблички скорочень
     */
    public function getIdFromShortId(string $short_id):int {
        $res = $this->where('short_id', $short_id)->first();
        return (int)$res->id;
    }


}
