<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentRequest;
use App\Http\Resources\PostCommentResource;
use App\PostComment;

class PostCommentController extends Controller
{
    /**
     * Цей контроллер працюватиме лише як аякс
     * @var PostComment
     */

    private PostComment $PostComment;
    function __construct(){
        $this->PostComment = new PostComment();
    }

    function add_new_comment(PostCommentRequest $request){
        $res = $this->PostComment->addNewComment(
            (int)$request->input('post_id'),
            $request->input('comment'),
            (int)$request->input('request_id', 0)
        );
        return response()->json(['status' => $res]);
    }

    function get_comments_from_post($post_id){
        return new PostCommentResource($this->PostComment
            ->where('post_id', (int)$post_id)
            ->leftJoin('users', 'post_comments.user_id' , '=', 'users.id')
            ->select('users.name', 'users.email', 'post_comments.*')
            ->orderBy('created_at', 'desc')
            ->get());
    }
}
