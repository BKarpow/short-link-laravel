<?php

namespace App;

use App\Traits\PostTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Tags extends Model
{
    use PostTrait;

    /**
     * Створює нову мітку
     * @param string $name імя мітки
     */
    function createNew(string $name):void
    {
        $name = trim($name, ',');
        $this->alias = $this->getAliasFromString($name);
        $this->name = $name;
        $this->save();
    }

    /**
     * Повертає id мітки по її назві
     * @param string $tag
     * @return int
     */
    function getIdFromTag(string $tag):int
    {
        if (empty($tag)) return 0;
        $tag = DB::table('tags')
                ->where('alias', '=', $tag)
                ->select('id', 'name')
                ->limit(1)
                ->get();
        if ($tag)
            return (int)$tag[0]->id;
        else
            return 0;
    }


}
