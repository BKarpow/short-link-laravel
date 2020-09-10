<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Http\Requests\ApiRequest;
use App\{ApiToken, Shorts };
use App\Http\Resources\Shorts as ShortsResource;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    private ApiToken $ApiToken;
    private Shorts $Shorts;

    public function __construct(){
        $this->ApiToken = new ApiToken();
        $this->Shorts = new Shorts();
    }

    public function add_new_short(Request $request){
        $token = $request->input('token');
        try{
            $this->validate($request ,[
                'url' => 'required|url',
                'token' => 'required'
            ]);
        }catch (ValidationException $ve){
            die('Error data');
        }

        $url = $request->input('url');

        $user_id = $this->ApiToken->getUserIdFromApiToken($token);
        if ($user_id){
            $short_id = $this->Shorts->addNewShort($url, $user_id);
            return new ShortsResource(Shorts::where('short_id', $short_id)->first());
        }else{
            abort(401);
        }
        return '';
    }


    public function show_all_shorts(Request $request){
        $token = $request->input('token');
        $user_id = $this->ApiToken->getUserIdFromApiToken($token);
        return new ShortsResource(Shorts::where('user_id', $user_id)->get());
    }

}
