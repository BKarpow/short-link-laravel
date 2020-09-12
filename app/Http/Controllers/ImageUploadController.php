<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    function upload_image(Request $request){
        $path = $request->file('file')
            ->store('local');
        return response()->json(['path' => $path]);
    }
}
