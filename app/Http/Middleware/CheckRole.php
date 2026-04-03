<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next,String $role): Response
    {
        $user = auth('api')->user();
        if(!$user || $user->role!==$role){
            return response()->json(['message' => 'Accès refusé : vous n\'avez pas le rôle requis.'], 403);
        }
        return $next($request);
    }
}
