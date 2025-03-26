<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;


class BrandController extends Controller
{
    public function showRegistrationForm()
    {
        return view('brand.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:brands,email',
            'phone' => 'required|unique:brands,phone',
            'license' => 'required|file|mimes:pdf,jpg,png|max:2048', // Allow PDF, JPG, PNG
        ]);

        // Upload License File
        $licensePath = $request->file('license')->store('licenses', 'public');

        // Store Brand Data
        Brand::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'license' => $licensePath,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Your application has been submitted for review.');
    }

    public function showLoginForm()
    {
        return view('brand.login');
    }
}
