<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCompanyNoAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = User::find(auth()->id());
        if(count($user->company) >= $user->company_no){
            return redirect('/dashboard', 302)->with('error', 'Not Authorized');
        }

        return $next($request);
    }
}
