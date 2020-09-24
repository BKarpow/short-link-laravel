<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MediaRequest;
use App\Media;
use App\Http\Resources\MediaResource;

class MediaController extends Controller
{
    private Media $Media;
    function __construct(){
        $this->Media = new Media();
    }


    function add_new(){
        return view('admin.pages.media.add');
    }

    function add_new_action(MediaRequest $request){
        $this->Media->addNewMedia(
            $request->input('title'),
            $request->input('description'),
            $request->input('file')
        );
        return redirect()->route('media-add')->with('status', 'Медіа додано');
    }

    function ajax_get_all(){
        return new MediaResource($this->Media
            ->where('user_id', auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->get());
    }

    function ajax_upload_image(Request $request){
        $this->validate($request, [
            'file' => 'image'
        ]);
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $fileSize = $file->getSize();
        $path = $file->store('local/media/images/'.$request->user()->id);
        $this->Media->addNewMedia($fileName,
            'Upload file',
            '/storage/app/'.$path,
            (int)$fileSize);
        return response()->json(['path' => '/storage/app/'.$path]);
    }
}
