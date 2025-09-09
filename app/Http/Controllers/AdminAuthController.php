<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // Show admin registration form
    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    // Handle admin registration
    public function register(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|unique:admins',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);

        $admin = Admin::create([
            'admin_id' => $request->admin_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard');
    }

    // Show admin login form
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Handle admin login
    public function login(Request $request)
    {
        $request->validate([
            'admin_id' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($request->only('admin_id', 'password'))) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'admin_id' => 'Invalid admin ID or password.',
        ]);
    }

    // Admin dashboard
    public function dashboard()
    {
        $bookings = \App\Models\Booking::with(['sport', 'student'])
            ->orderBy('date')
            ->orderBy('slot')
            ->get();

        return view('admin.dashboard', compact('bookings'));
    }


    // Logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
