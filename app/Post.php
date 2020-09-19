<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\PostTrait;

class Post extends Model
{
    use PostTrait;
    /**
     * Створює новий плст (статтю)
     * @param string $title
     * @param string $short_text
     * @param string $content
     * @param string $main_img
     * @param int $category_id
     * @return bool
     */
    public function createNew(string $title, string $short_text, string $content, string $main_img, int $category_id):bool
    {
          $this->user_id = (int)auth()->user()->id;
          $this->category_id = $category_id;
          $this->title = $title;
          $this->alias = $this->getAliasFromString($title);
          $this->short_text = $short_text;
          $this->main_img = $main_img;
          $this->text = $content;
          return (bool)$this->save();
    }

    /**
     * Повертає публічні пости
     * @return Builder
     */
    public function getPublicPost():Builder
    {
        return $this->where('public', '1');
    }


}
