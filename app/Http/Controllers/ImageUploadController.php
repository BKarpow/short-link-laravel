<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    function upload_image(Request $request){
        $this->validate($request, [
            'file' => 'image'
        ]);
        $path = $request->file('file')
            ->store('local');
        return response()->json(['path' => $path]);
    }

    public function delete_image(Request $request){
        $path_file = $request->input('path', false);
        if ($path_file){
            Storage::delete($path_file);
            return response()
                ->json(['delete'=>true]);
        }
        return response()
            ->json( ['delete' => false] );
    }

    public function upload(Request $request)
    {
        $this->validate($request, ['file' => 'image']);
        $path =  'local/images/upload/users/'.auth()->user()->id.'/';
        $file = $request->file('file')->store($path);
        return response()->json(['path' => '/storage/app/'.$file]);
    }
}
