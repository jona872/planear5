<?php

namespace App\Http\Middleware;

use Closure;

class API {

    public function handle($request, Closure $next)
    {
            $response = $next($request);
            $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Content-Range, Content-Disposition, Content-Description, X-Auth-Token');
            $response->header('Access-Control-Allow-Origin', '*');
            //add more headers here
            return $response;
        }
}




// class Authenticate extends Middleware
// {
//     /**
//      * Get the path the user should be redirected to when they are not authenticated.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return string|null
//      */
//     protected function redirectTo($request)
//     {
//         if (! $request->expectsJson()) {
//             return route('login');
//         }
//     }
// }
