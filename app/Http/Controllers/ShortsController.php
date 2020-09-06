<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortsRequest;
use App\Shorts;

class ShortsController extends Controller
{
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
        $short->increment('linked');
        return redirect( $short->url);
    }
}
