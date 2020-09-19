<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PostTrait;

class Pages extends Model
{
    use PostTrait;
    /**
     * Створю новий запис в таблиці сторінок
     * @param string $title
     * @param string $alias
     * @param string $page
     * @return bool
     */
    public function addNew(string $title, string $alias, string $page):bool
    {
        $alias = $this->getAliasFromString($alias);
        $this->title = $title;
        $this->alias = $alias;
        $this->page = $page;
        return (bool) $this->save();
    }

    /**
     * Перевіряє чи унікальний (url) аліас
     * @param string $alias
     * @return bool
     */
    public function isUniqueAlias(string $alias):bool
    {
        $alias = $this->getAliasFromString($alias);

        return !(bool) $this->where('alias', $alias)->first();

    }
}
