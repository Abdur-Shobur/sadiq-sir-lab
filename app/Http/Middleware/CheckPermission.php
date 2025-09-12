<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
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

        // For regular users (web guard), they have all permissions
        if (Auth::guard('web')->check()) {
            return $next($request);
        }

        // For team members, check permissions
        if (method_exists($user, 'hasPermission') && ! $user->hasPermission($permission)) {
            abort(403, 'Unauthorized access. You do not have permission to perform this action.');
        }

        return $next($request);
    }
}
