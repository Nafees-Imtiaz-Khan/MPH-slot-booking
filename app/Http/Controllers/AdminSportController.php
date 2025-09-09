<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;

class AdminSportController extends Controller
{
    // Add a new sport
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sports,name',
            'boards' => 'required|integer|min:1|max:10',
        ]);

        Sport::create([
            'name' => $request->name,
            'boards' => $request->boards,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Sport added successfully.');
    }

    // Delete an existing sport
    public function destroy(Sport $sport)
    {
        $sport->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Sport deleted successfully.');
    }
}
