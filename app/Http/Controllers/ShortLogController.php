<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{ShortLog, Shorts};

class ShortLogController extends Controller
{
    private ShortLog $ShortLog;
    private Shorts $Shorts;
    private int $countItemsPage = 15;

    public function __construct(){
        $this->ShortLog = new ShortLog();
        $this->Shorts =  new Shorts();
    }

    public function show($short_id){
        if (!auth()->check()){
            return redirect('/');
        }
        $short_id = $this->Shorts->getIdFromShortId($short_id);
        return view('logList', ['data' => $this->
        ShortLog
            ->where('short_id', (int)$short_id)
            ->paginate($this->countItemsPage)
        ]);
    }
}
