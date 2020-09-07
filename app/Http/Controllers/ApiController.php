<?php

namespace App\Http\Controllers;

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
        $url = $request->input('url');
        $user_id = $this->ApiToken->getUserIdFromApiToken($token);
        if ($user_id && !empty($url)){
            $this->ApiToken->incrementRequestsCount($token);
            $short_id = $this->Shorts->addNewShort($url, $user_id);
            return new ShortsResource(Shorts::where('short_id', $short_id)->first());
//            return $short_id;
        }else{
            abort(401);
        }
        return 'test';
    }


}
