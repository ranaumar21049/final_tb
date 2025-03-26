<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class BrandAdminMiddleware
{
    
   public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('brand_admin')->check()) {
            return redirect()->route('brand-admin.login');
        }
        return $next($request);
    }
}
