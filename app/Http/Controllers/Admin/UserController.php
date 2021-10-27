<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index', [
            'title' => 'User',
            'users' => User::all()
        ]);
    }

    public function update_role(User $user, Request $request)
    {
        $request->validate(['is_admin' => 'boolean']);
        $user->is_admin = $request->is_admin;
        $user->save();

        return redirect()->back()->with("success", "Success Updating User Role");
    }
}
