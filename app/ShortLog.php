<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ShortLogTrait;

class ShortLog extends Model
{
    use ShortLogTrait;

    /**
     * Логую переходи по скороченням
     * @param (int)short_row_id - ід запису скорочення
     * @return void
     */
    public function logging(int $short_row_id):void{
        $this->short_id = $short_row_id;
        $this->ip = $this->getIp();
        $this->user_agent = $this->getUserAgent();
        $this->save();
    }
}
