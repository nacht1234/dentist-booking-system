<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;  // your Role model
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();  // to populate dropdown
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        // Detach old roles and attach new one (assuming single role per user)
        $role = Role::where('name', $request->role)->first();
        $user->roles()->sync([$role->id]);

        return redirect()->route('admin.users.index')->with('success', 'User role updated.');
    }
}

