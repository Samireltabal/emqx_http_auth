<?php

namespace SamirEltabal\EmqxAuth\Middlewares;

use Closure;
use Illuminate\Http\Request;

class setHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('accept', 'application/json');
        if( 
            $request->has('Auth') &&
            $request->has('uuid') &&
            $request->has('client_id')
          ){
            $request->headers->set('Authorization', 'Bearer ' . $request->input('Auth'));
            return $next($request);
        } else {
            return response()->json([
                'message' => 'request is not compatible with emqx auth package',
                'Debug' => [
                    'Authorization Header Existance' => $request->headers->has('Authorization'),
                    'uuid existance' => $request->has('uuid'),
                    'client id existance' => $request->has('client_id'),
                    'Bearer Format' => \Str::contains($request->header('Authorization'), 'Bearer ')
                ],
                'example' => [
                    'headers' => [
                        'Authorization' => 'Bearer ${token}',
                    ],
                    'body' => [
                        'uuid',
                        'client_id'
                    ]
                ]
            ], 401);
        }
    }
}
