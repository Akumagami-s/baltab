<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
class apiSpecial
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

       try {

        if (!is_null($request->header('specToken'))) {
            if ($request->header('specToken') == "eyJpdiI6IktxSmlSV1k1WW1ZWTJKaGdXK2FnM2c9PSIsInZhbHVlIjoiYVgwbndSdDN4bGhFdmkrWGIzY3VCZk95UjFiT2pjYWRWd0RaSEdXaTl2ST0iLCJtYWMiOiIxN2VmMDZhMWRkMTZkNmFkNTBjM2U0ZDhjNmJlZmZhMmI2ODc2ZTdlY2ZlZTcwNzMyNjIxZjY4OTExODZiYmE2IiwidGFnIjoiIn0=") {

        return $next($request);
            }
            else {
                return response()->json(['message'=>'TOKEN SPECIAL ANDA SALAH'], 200);
            }
        }
       } catch (\Throwable $th) {
          return response()->json(['message'=>'anda tidak memiliki izin ke dalam api ini '], 200);
       }


    }
}
