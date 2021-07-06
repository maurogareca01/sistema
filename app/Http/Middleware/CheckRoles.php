<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request; 
use App\Models\User; 
class CheckRoles
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
        $role=func_get_args();
        $role=array_slice($role,2);


        if ( auth()->user()->hasRoles($role) ){
            return $next($request);
        }
        return redirect('/');
    }
}
