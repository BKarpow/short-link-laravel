<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\PostTrait;
use App\Tags;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use PostTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'title', 'alias', 'short_text', 'text', 'main_img'
    ];

    /**
     * Створює новий плст (статтю)
     * @param string $title
     * @param string $short_text
     * @param string $content
     * @param string $main_img
     * @param int $category_id
     * @param string $tags
     * @return bool
     */
    public function createNew(string $title,
                              string $short_text,
                              string $content,
                              string $main_img,
                              int $category_id,
                              string $tags):bool
    {
        $Tags = new Tags();
        $createArray = [
            'user_id' => (int)auth()->user()->id,
            'category_id' => $category_id,
            'title' => $title,
            'alias' => $this->getAliasFromString($title),
            'short_text' => $short_text,
            'main_img' => $main_img,
            'text' => $content
        ];
          $r = $this->create($createArray);
          if ($r !== false || $r->id){
              $tags = explode('|', $tags);

              if (!empty($tags)){
                  foreach ($tags as $item) {
                        $id_tag = $Tags->getIdFromTag($item);
                        if ($id_tag)
                            $this->createRelationFromTag((int)$id_tag, (int)$r->id);
                  }
              }

          }else{
              return false;
          }
          return (bool) $r;
    }

    /**
     * Повертає публічні пости
     * @return Builder
     */
    public function getPublicPost():Builder
    {
        return $this->where('public', '1');
    }

    /**
     * Створює звязок між постом та міткою
     * @param int $id_tags
     * @param int $id_post
     * @return bool
     */
    function createRelationFromTag(int $id_tags, int $id_post):bool
    {
        return (bool) DB::table('post_tags')->insert([
            'tag_id' => $id_tags,
            'post_id' => $id_post
        ]);
    }

    /**
     * Поаертає всі мітки для посту
     * @param int $post_id
     * @return Collection
     */
    function getAllTagsFromPost(int $post_id): Collection
    {
        return DB::table('post_tags')
            ->where('post_id', $post_id)
            ->select('tags.name', 'tags.alias', 'tags.id', DB::raw('post_tags.id as pt_id'))
            ->leftJoin('tags', 'tags.id', '=', 'post_tags.tag_id')
            ->get();
    }

}
