<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Token
{
  
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $validSecrets = explode(',', env('ACCEPTED_SECRETS'));
        if (in_array($request->header('Authorization'), $validSecrets)) {
            return $next($request);
        }

        abort(Response::HTTP_UNAUTHORIZED);
    }
}
