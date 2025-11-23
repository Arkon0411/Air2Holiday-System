<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('adminpanel.users.index', compact('users'));
    }

    public function create()
    {
        return view('adminpanel.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'usertype' => 'required|in:user,admin,airline',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('adminpanel.users.index');
    }

    public function edit(User $user)
    {
        return view('adminpanel.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => "required|email|unique:users,email,{$user->id}",
            'usertype' => 'required|in:user,admin,airline',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('adminpanel.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('adminpanel.users.index');
    }
}
