<?php

namespace Anla\Skipper\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Anla\Skipper\Models\User;

class SkipperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            return redirect()->route('skipper.login');
        }

        /*
         * Get the Skipper User Object.
         *
         * @var \Anla\Skipper\Models\User
         */
        $user = User::find(Auth::id());

        return $user->hasRole('admin') ? $next($request) : redirect('/');
    }
}
