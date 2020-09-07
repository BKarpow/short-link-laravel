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

    }

    public function create_token(){
        $token = $this->ApiToken->createToken();
        return view('admin.pages.tokens.add', ['token' => $token]);
    }

    public function delete_token($token){
        $this->ApiToken->deleteToken((string)$token);
        return redirect('/admin')->with('status', 'Запис ' . $token . ' видалено!');
    }

    public function toggle_token($token){
        $this->ApiToken->toggleToken($token);
        return redirect('/admin')->with('status', 'Перемикач задіяно.');
    }

    public function show(){
        $data = $this->ApiToken
                     ->where('user_id', auth()->user()->id)
                     ->paginate($this->contItemsFromPage);
        return view('admin.pages.tokens.list', ['data' => $data]);
    }
}
