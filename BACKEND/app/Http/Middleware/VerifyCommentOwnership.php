<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCommentOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if the comment belongs to the user
        if (!$request->comment->user()->is(auth()->user())) {
            return response()->json([
                'message' => 'You are not authorized to perform this action'
            ], 403);
        }
        return $next($request);
    }
}
