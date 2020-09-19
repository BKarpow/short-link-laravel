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

    public function update_category($id){
        $id = (int)$id;
        $update_category = CategoryPost::find($id);
        if (!$update_category){
            abort(404);
        }
        return view('admin.pages.categoryposts.create',
            [
                'categories' => CategoryPost::select('id', 'parent_category', 'title')->get(),
                'data' => $update_category,
                'id' => $id
            ]
        );
    }

    public function update_category_action(CategoryPostRequest $request, $id){
        $id = (int)$id;
        $CategoryPost = new CategoryPost();
        $result = $CategoryPost->updateCategory(
            $id,
            $request->input('title'),
            $request->input('description'),
            $request->input('icon_path', 'none'),
            (int)$request->input('parent', '0')
        );
        return redirect()->route('list-all-category')->with('status', 'Категорію оновлено!');
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


    public function delete_category($id){
        $CategoryPost = new CategoryPost();
        $id = (int)$id;
        $CategoryPost->deleteCategory($id);
        return redirect()->route('list-all-category')->with('status', 'Категгорію видалено');

    }



}
