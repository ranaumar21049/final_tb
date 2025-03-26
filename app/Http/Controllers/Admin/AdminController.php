<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\BrandAdmin;
use App\Models\User;
use App\Mail\BrandApproved;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function showLoginForm()
    {
        return view('admin.login');
    }
    public function index()
    {
        $brands = Brand::where('status', 'pending')->get();
        return view('admin.brands', compact('brands'));
    }
    public function dashboard()
    {
        $brands = Brand::where('status', 'pending')->get();
        return view('admin.brands', compact('brands'));
    }

    public function approve($id)
    {
        $brand = Brand::findOrFail($id);

        // Generate a random password
        $password = Str::random(10);

        // Create a new user account for the brand admin
        $brandAdmin = BrandAdmin::create([
            'brand_id'=> $brand->id,
            'name' => $brand->name . ' Admin',
            'email' => $brand->email,
            'password' => Hash::make($password),
        
        ]);

        // Update brand status to 'approved'
        $brand->update(['status' => 'approved']);

        // Send credentials via email
        
        Mail::to($brandAdmin->email)->send(new BrandApproved($brandAdmin->email, $password));

        return redirect()->back()->with('success', 'Brand approved, and login details sent via email.');
    }

    public function reject($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->update(['status' => 'rejected']);

        return redirect()->back()->with('error', 'Brand rejected.');
    }

}
