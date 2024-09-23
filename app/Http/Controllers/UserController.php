<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(5);
        $totalUsers = User::count();
        $lastWeekUsers = User::whereDate('created_at', '>=', now()->subWeek())->count();
        $change = $totalUsers - $lastWeekUsers;

        return view('backend.dashboard', compact('users', 'totalUsers', 'change'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::paginate(5);
        $totalUsers = User::count();
        $lastWeekUsers = User::whereDate('created_at', '>=', now()->subWeek())->count();
        $change = $totalUsers - $lastWeekUsers;
        return view('backend.dashboard', compact('users', 'totalUsers', 'change'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function prosesCreate(Request $request)
    {
        // Validasi input
        $validate = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        // Membuat user baru
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
            return redirect()->route('dashboard.index')->with('error', 'User not found.');
        }
    }

}
