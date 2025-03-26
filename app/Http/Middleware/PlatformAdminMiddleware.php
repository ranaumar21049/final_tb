<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PlatformAdmin;
use Illuminate\Support\Facades\Auth;

class PlatformAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in
        if (!Auth::guard('platformadmin')->check()) {
            return redirect()->route('platform-admin.login');
        }
        
        $user = Auth::guard('platformadmin')->user();
        if (PlatformAdmin::where('email', $user->email)->exists()) {
            return $next($request);
        }
        

        abort(403, 'Unauthorized Access');
    }
}
