<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PostTrait;

class CategoryPost extends Model
{
    use PostTrait;

    /**
     * Створую нову категорію
     * @param string $title
     * @param string $description
     * @param string $icon_path
     * @param int $parent_id
     * @return bool
     */
    public function createNew(string $title, string $description, string $icon_path, int $parent_id) {
        $alias = $this->getAliasFromString($title);
        $this->title = $title;
        $this->parent_category = $parent_id;
        $this->alias = $alias;
        $this->icon_path = $icon_path;
        $this->description = $description;
        $this->public = true;
        return (bool) $this->save();
    }

    /**
     * Оновлює категорію
     * @param int $id категорії
     * @param string $title
     * @param string $description
     * @param string $icon_path
     * @param int $parent_id
     * @return bool
     */
    public function updateCategory(int $id, string $title, string $description, string $icon_path, int $parent_id):bool {
        return (bool) $this->where('id', $id)
            ->update(
                [
                    'title' => $this,
                    'description' => $description,
                    'icon_path' => $icon_path,
                    'parent_category' => $parent_id
                ]
            );
    }

}
