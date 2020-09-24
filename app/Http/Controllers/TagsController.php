<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagsResource;
use App\Tags;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TagsController extends Controller
{
    function show_all(){
        return view('admin.pages.tags.list', ['data' => Tags::paginate(15)]);
    }

    function delete_tag($tag_id){
        $tag_id = (int)$tag_id;
        Tags::where('id', $tag_id)->delete();
        return redirect()->route('tags.all')->with('status', 'Видалено мітку id '.$tag_id);
    }

    function ajax_get_all(){
        $Tags = new Tags();
        return new TagsResource($Tags->all());
    }

    function ajax_new(Request $request){
        $Tags = new Tags();
        $response = ['status' => false, 'error' => ''];
        try {
            $this->validate($request, [
                'name' => 'required|max:249|min:2|string|unique:tags,name'
            ]);
        } catch (ValidationException $e) {
            $response['status'] = false;
            $response['error'] = $e->getMessage();
            return response()->json($response);
        }
        $Tags->createNew($request->input('name'));
        return response()->json(['status' => true]);
    }

}
