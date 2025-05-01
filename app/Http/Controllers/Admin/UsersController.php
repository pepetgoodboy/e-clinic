<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->query('search');

            $users = User::query()
                ->when($search, function($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString();

            return view('admin.users.index', compact('users', 'search'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function create()
    {
        try {
            $users = User::all();
            return view('admin.users.create', compact('users'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $user->assignRole([$request->role]);

            return redirect()->route('users.list')->with('success', 'User berhasil ditambahkan.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }


    public function edit(User $user)
    {
        try {
            $users = User::all();
            return view('admin.users.edit', compact('user', 'users'));
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $user->syncRoles([$request->role]);

            return redirect()->route('users.list')->with('success', 'User berhasil diupdate.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.list')->with('success', 'User berhasil dihapus.');
        } catch (\Throwable $e) {
            report($e);
            abort(500);
        }
    }
}