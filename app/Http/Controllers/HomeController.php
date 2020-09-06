<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shorts;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Shorts = new Shorts();
        $my_shorts = $Shorts->where('user_id', auth()->user()->id)
            ->paginate(15);
        return view('welcome', ['my_shorts' => $my_shorts]);
    }
}
