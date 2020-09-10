<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shorts;

class AdminHomeController extends Controller
{
    public function index(){
        $Shorts = new Shorts();
        return view('admin.home' , ['data' => $Shorts->getAllShortsFromAllUsers()]);
    }
}
