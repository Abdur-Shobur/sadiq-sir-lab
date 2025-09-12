<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if user is authenticated via web guard (admin users)
        $user = Auth::guard('web')->user();

        // If not web user, check team guard (team members)
        if (! $user) {
            $user = Auth::guard('team')->user();
        }

        if (! $user) {
            abort(403, 'Unauthorized access. Please login first.');
        }

        // For regular users (web guard), they have all roles
        if (Auth::guard('web')->check()) {
            return $next($request);
        }

        // For team members, check roles
        if (method_exists($user, 'hasRole') && ! $user->hasRole($roles)) {
            abort(403, 'Unauthorized access. You do not have the required role.');
        }

        return $next($request);
    }
}
