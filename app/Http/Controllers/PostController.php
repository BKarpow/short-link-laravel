<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\{Post, CategoryPost};

class PostController extends Controller
{
    public function create_add(){
        $CategoryPost = new CategoryPost();
        return view('admin.pages.posts.create', ['categories' => $CategoryPost->all()]);
    }

    public function create_add_action(PostRequest $request){
        $Post = new Post();

        $Post->createNew(
            $request->input('title'),
            $request->input('short_text'),
            $request->input('text'),
            (int)$request->input('category_id')
        );
        return redirect()->route('create-post')->with('status', 'Стаття додана успішно');
    }
}
