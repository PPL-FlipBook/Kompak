<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\LogActivity;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Paginate users for display
        $users = User::paginate(5);

        // Count total books and users
        $totalBooks = Book::count();
        $totalUsers = User::count();

        // Count books and users created since last week
        $changeBooks = Book::where('created_at', '>=', now()->subWeek())->count();
        $changeUsers = User::where('created_at', '>=', now()->subWeek())->count();

        // Calculate changes (optional, depending on your display needs)
        $changeB = $changeBooks; // This represents the number of new books
        $change = $changeUsers; // This represents the number of new users

        // Get the latest log activity (if needed)
        $subjectId = LogActivity::where('event', 'created')->latest()->first();

        // Pass the data to the view
        return view('backend.dashboard', compact('users', 'user', 'totalUsers', 'changeB', 'change', 'subjectId', 'totalBooks', 'changeBooks', 'changeUsers'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user(); // Add this line
        $users = User::paginate(5);
        $totalUsers = User::count();
        $lastWeekUsers = User::whereDate('created_at', '>=', now()->subWeek())->count();
        $change = $totalUsers - $lastWeekUsers;
        $subjectId = LogActivity::where('event', 'created')->latest()->first();
        return view('backend.dashboard', compact('users', 'user', 'totalUsers', 'change', 'subjectId')); // Add 'user' to compact
    }

    /**
     * Store a newly created resource in storage.
     */
    public function prosesCreate(Request $request)
    {
        // Validate input
        $validate = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        // Create new user
        $user = new User();
        $user->name = $validate['name'];
        $user->email = $validate['email'];
        $user->password = bcrypt($validate['password']);
        $user->role = $validate['role'];

        try {
            $user->save();
            return redirect()->route('dashboard.index')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.index')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.dashboard', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validate = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'role' => 'required',
        ]);

        $user->name = $validate['name'];
        $user->email = $validate['email'];
        $user->role = $validate['role'];

        if (!empty($validate['password'])) {
            $user->password = bcrypt($validate['password']);
        }

        try {
            $user->save();
            return redirect()->route('dashboard.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.index')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->delete();
            return redirect()->route('dashboard.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.index')->with('error', 'User could not be deleted: ' . $e->getMessage());
        }
    }
}
