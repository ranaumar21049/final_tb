<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    // Attempt to log in as Platform Admin
    if (Auth::guard('platformadmin')->attempt($credentials)) {
        return redirect()->intended('platform-admin/dashboard');
    }

    // Attempt to log in as Brand Admin
    if (Auth::guard('brand_admin')->attempt($credentials)) {
        return redirect()->intended('brand-admin/dashboard');
    }

    // Attempt to log in as Customer
    if (Auth::guard('web')->attempt($credentials)) {
        return redirect()->intended('customer/dashboard');
    }

    // If authentication fails for all guards
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}



public function logout(Request $request)
{
    if (Auth::guard('platformadmin')->check()) {
        Auth::guard('platformadmin')->logout();
        return redirect()->route('platform-admin.login');
    }

    if (Auth::guard('brand_admin')->check()) {
        Auth::guard('brand_admin')->logout();
        return redirect()->route('brand-admin.login');
    }

    if (Auth::guard('web')->check()) {
        Auth::guard('web')->logout();
        return redirect()->route('customer.login');
    }

    // Default logout if no guard is active
    Auth::logout();
    return redirect()->route('login');
}

}
