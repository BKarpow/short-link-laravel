<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryPostRequest;
use App\CategoryPost;

class CategoryPostController extends Controller
{

    public function show_category_list(){
        return view('admin.pages.categoryposts.list',
        ['data' => CategoryPost::paginate(15)]);
    }

    public function create_category(){
        return view('admin.pages.categoryposts.create',
        ['categories' => CategoryPost::select('id', 'parent_category', 'title')
            ->get()]);
    }

    public function create_category_action(CategoryPostRequest $request){
        $CategoryPost = new CategoryPost();
        $result = $CategoryPost->createNew(
            $request->input('title'),
            $request->input('description'),
            $request->input('icon_path', 'none'),
            (int)$request->input('parent', '0')
        );
        return redirect('/admin')->with('status', 'Категорію додано');
    }




}
