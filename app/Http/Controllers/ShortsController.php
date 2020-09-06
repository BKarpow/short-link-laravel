<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortsRequest;
use App\{Shorts, ShortLog};


class ShortsController extends Controller
{
    private ShortLog $ShortLog;
    public function __construct(){
        $this->ShortLog = new ShortLog();
    }
    public function add_new_short(ShortsRequest $request){
        $shorts = new Shorts();
        $short_id = $shorts->addNewShort($request->input('url'));
        return redirect('/')->with('short_link',  asset('/' . $short_id) );
    }

    public function redirect_to_short(string $short_id){
        $shorts = new Shorts();
        $short = $shorts->where('short_id', '=', $short_id)->first();
        if (!$short){
            abort(404);
        }
        $this->ShortLog->logging($short->id);
        $short->increment('linked');
        return redirect( $short->url);
    }
}
