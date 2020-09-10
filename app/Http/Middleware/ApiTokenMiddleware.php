<?php

namespace App\Http\Middleware;

use Closure;
use App\ApiToken;

class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $ApiToken = new ApiToken();
        $token = $request->input('token');
        if (!$token || !$ApiToken->isToken($token)){
            sleep(1);
            die('Error token');
        }
        return $next($request);

    }
}
