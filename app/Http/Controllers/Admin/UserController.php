<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.pages.user.index', [
            'users' => User::all(),
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'password' => 'confirmed'
        ]);

        User::create($request->all());

        return back();
    }

    public function edit(User $user)
    {
        return back()->with([
            'data' => $user,
            'isModalOpen' => true,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }
}
