<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('admin-login'); // create this Blade view
    }

    // Handle login
    public function login(Request $request) 
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Find admin by email
        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            // Store admin data in session
            Session::put('admin_id', $admin->id);
            Session::put('admin_name', $admin->name);

            return redirect()->route('admin.dashboard'); // create admin dashboard route
        } else {
            return back()->withErrors(['email' => 'Invalid email or password']);
        }
    }

    // Handle logout
    public function logout()
    {
        Session::flush(); // remove all admin session data
        return redirect()->route('admin.login');
    }
}
