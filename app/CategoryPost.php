<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PostTrait;
use Illuminate\Support\Facades\Storage;

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
        $this->parent_category = (int)$parent_id;
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
                    'title' => $title,
                    'description' => $description,
                    'icon_path' => $icon_path,
                    'parent_category' => $parent_id
                ]
            );
    }


    /**
     * Видаляє категорію
     * @param int $category_id
     * @return bool
     */
    public function deleteCategory(int $category_id):bool {
        $file = $this->where('id', $category_id)->select('icon_path')->first();
        Storage::delete(str_replace('/storage/app/', '', $file->icon_path));
        return (bool)$this->where('id', $category_id)->delete();
    }

}
