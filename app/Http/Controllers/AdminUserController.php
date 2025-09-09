<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // Show all students
    public function index()
    {
        $students = User::all();
        return view('admin.students', compact('students'));
    }

    // Ban a student
    public function ban(User $user)
    {
        $user->update(['is_banned' => true]);
        return redirect()->back()->with('success', 'Student banned successfully.');
    }

    // Unban a student
    public function unban(User $user)
    {
        $user->update(['is_banned' => false]);
        return redirect()->back()->with('success', 'Student unbanned successfully.');
    }
}
