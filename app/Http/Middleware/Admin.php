<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
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
        $user = Auth::user();

        if($user->group != 2){ //2 = Admin
            return redirect()->back()->withErrors([
                'errors' => [
                    'Usuário não autorizado!'
                ]
            ]);
        }

        return $next($request);
    }
}
