<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfAdmin
{
    /**
     * Check that the logged in user is an administrator.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable|null  $user
     * @return bool
     */
    private function checkIfUserIsAdmin($user)
    {
        // Only allow access if the user is logged in AND is_admin=1
        return ($user && $user->is_admin == 1);
    }

    /**
     * Handle a request for non-logged-in or non-admin users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    private function respondToUnauthorizedRequest($request)
    {
        // If it's an AJAX request, return a 401
        if ($request->ajax() || $request->wantsJson()) {
            return response(trans('backpack::base.unauthorized'), 401);
        }

        // Otherwise, redirect the user to your main login page
        return redirect()->guest('/login');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If user is NOT logged in, redirect to /login
        if (Auth::guest()) {
            return $this->respondToUnauthorizedRequest($request);
        }

        // If user is logged in but not admin, redirect to /login
        if (! $this->checkIfUserIsAdmin(Auth::user())) {
            return $this->respondToUnauthorizedRequest($request);
        }

        // Otherwise proceed
        return $next($request);
    }
}
