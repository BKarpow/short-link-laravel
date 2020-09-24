<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PostComment extends Model
{
    /**
     * Повертає колекцію коментарів до запису, або null
     * @param int $post_id ід запису
     * @return mixed
     */
    function getCommentsFromPost(int $post_id)
    {
        return $this->where('post_id', $post_id)->paginate(20);
    }

    /**
     * Створює новий коментар до запису
     * @param int $post_id
     * @param string $comment
     * @param bool $moder
     * @param int $request
     * @return bool
     */
    function addNewComment(int $post_id, string $comment, int $request = 0, bool $moder = false):bool
    {
        $this->user_id = (int)auth()->user()->id;
        $this->post_id = (int)$post_id;
        $this->moderation = $moder;
        $this->request_id = $request;
        $this->comment = strip_tags( $comment);
        return $this->save();
    }
}
