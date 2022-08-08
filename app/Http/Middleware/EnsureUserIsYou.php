<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsYou
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        foreach ($request->route()->parameters() as $entity) {
            if (method_exists($entity, 'user') && $entity->user->id !== $request->user()->id) {
                return redirect()->route('unauthorized');
            }
            if ($entity->user_id && $entity->user_id !== $request->user()->id) {
                return redirect()->route('unauthorized');
            }
        }
        return $next($request);

    }
}
