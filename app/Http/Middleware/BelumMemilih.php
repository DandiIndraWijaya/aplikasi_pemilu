<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemilihan;

class Pemilih
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
        $user = \App\Models\User::where('id', Auth::id())->first();
        if ($user->role != 1 || $user->role == null ){
            return redirect()->back();
        }
        
        return $next($request);
    }
}
