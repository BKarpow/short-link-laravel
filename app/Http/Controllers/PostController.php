<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\{Post, CategoryPost};

class PostController extends Controller
{
    private Post $Posts;
    public function __construct(){
        $this->Posts = new Post();
    }

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
            $request->input('main_img'),
            (int)$request->input('category_id'),
            $request->input('tags')
        );
        return redirect()->route('create-post')->with('status', 'Стаття додана успішно');
    }

    function show_all(){
        $posts = $this->Posts->getPublicPost()->orderBy('created_at', 'desc')->paginate(15);
        return view('pages.post.list', ['data' => $posts]);
    }

    function show($id_alias){
        $id = (int)$id_alias;
        $posts = DB::table('posts')
                    ->where([['posts.public', '=', '1'], ['posts.id', '=', $id]])
                    ->leftJoin('category_posts', 'posts.category_id', '=', 'category_posts.id')
                    ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                     ->select(DB::raw('posts.id as post_id, posts.title as post_title, users.name as user_name'), 'posts.public', 'main_img', 'short_text', 'posts.created_at', 'previews', 'text', 'category_posts.title')
                    ->first();
        $post = Post::where([['public', '=', '1'],['id', '=', $id]])->first();
        if (!$post){
            abort(404);
        }
        $tags = $this->Posts->getAllTagsFromPost($id);
        $post->increment('previews');
        return view('pages.post.post', ['data' => $posts, 'tags' => $tags]);
    }

    function trigger_public($id){
        $Post = new Post();
        $post = $Post->where('id', (int)$id)->first();
        $post->public = !(bool)$post->public;
        $status_trigger = $post->public ? ' увімкнено ': ' вимкнено ';
        $id = $post->id;
        $post->save();
        return redirect()->route('list-all-post')->with('status', 'Статус публікації '.$id.' - '.$status_trigger);
    }

    function delete_post($id){
        $id = intval($id);
        Post::where('id', $id)->delete();
        return redirect()->route('list-all-post')->with('status', 'Видалено '.$id);
    }

    function show_list(){
        $posts = DB::table('posts')
//                    ->where([['posts.public', '=', '1'], ['posts.id', '=', $id]])
                    ->leftJoin('category_posts', 'posts.category_id', '=', 'category_posts.id')
                    ->leftJoin('users', 'posts.user_id', '=', 'users.id')
->select(
    DB::raw('posts.title as post_title, users.name as user_name, posts.id as post_id'),
    'posts.public',
    'main_img',
    'posts.created_at',
    'previews',
    'category_posts.title')
                    ->orderBy('posts.created_at', 'desc')
                    ->paginate(15);
        return view('admin.pages.posts.list', ['data' => $posts]);
    }

    function show_from_tag($tag_name){
        $posts_ids =
        $post = DB::table('posts')
            ->join('post_tags' , 'post_tags.post_id', '=', 'posts.id')
            ->join('tags', 'tags.id', '=', 'post_tags.tag_id')
            ->where('tags.alias', $tag_name)
            ->select('posts.*', 'tags.alias', 'tags.name')
            ->paginate(15);
        return view('pages.post.list', ['data' => $post]);
    }
}
