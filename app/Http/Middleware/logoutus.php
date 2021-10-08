<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
class logoutus
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
        Auth::logout();
        $value = $request->cookie('login');


        if (is_null($value)) {
            Auth::logout();
            return redirect('https://asiabytes.tech/login');
        }
        else {
            try {
                $decrypted = Crypt::decrypt($value);
            } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
                return $e;
            }


            if (!Auth::check()) {
                Auth::loginUsingId($decrypted, true);
            }

            return $next($request);
            }
    }
}
