<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ShortTrait;

class Shorts extends Model
{
    use ShortTrait;

    public function addNewShort(string $url){
        $short_id = $this->generate_short_id();
        $this->url = $url;
        $this->short_id = $short_id;
        $this->user_id = auth()->user()->id;
        $this->linked = 0;
        $this->save();
        return $short_id;
    }


}
