<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureStatusIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::find(auth()->id());
        if($user->has_paid == 0){
            if($user->reg_by_yana == 1){
                return redirect('/verify-payment');
            }else{
                return redirect('/payment');
            }
        }
        return $next($request);
    }
}
