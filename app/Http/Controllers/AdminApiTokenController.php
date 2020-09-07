<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiToken;

class AdminApiTokenController extends Controller
{
    private ApiToken $ApiToken;
    private int $user_id;
    private int $contItemsFromPage = 15;
    function __construct()
    {
        $this->ApiToken = new ApiToken();
//        $this->user_id =
    }

    public function create_token(){
        $token = $this->ApiToken->createToken();
        return view('admin.pages.tokens.add', ['token' => $token]);
    }

    public function show(){
        $data = $this->ApiToken
                     ->where('user_id', auth()->user()->id)
                     ->paginate($this->contItemsFromPage);
        return view('admin.pages.tokens.list', ['data' => $data]);
    }
}
