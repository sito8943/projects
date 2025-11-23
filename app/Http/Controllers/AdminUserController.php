<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('media')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            "avatar" => ['nullable', 'image'],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        // validated so it will be removed
        unset($validated['avatar']);

        $user = User::create($validated);

        if (
            $request->hasFile('avatar')
        ) {
            $user->addMediaFromRequest('avatar')->toMediaCollection();
        }

        return redirect('/admin/users');
    }

    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $id],
            'password' => ['nullable', 'string', 'min:8'],
            "avatar" => ['nullable', 'image'],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        $user = User::findOrFail($id);
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'] ?? null)) {
            $user->password = $validated['password'];
        }

        if ($request->has('is_admin')) {
            $user->is_admin = $request->boolean('is_admin');
        }

        if (
            $request->hasFile('avatar')
        ) {
            $user->media->each->delete();
            $user->addMediaFromRequest('avatar')->toMediaCollection();
            unset($validated['avatar']);
        }

        $user->save();

        return redirect('/admin/users');
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/admin/users');
    }
}
