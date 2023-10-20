<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AccountUpdate;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::whereRelation('role', 'name', '!=', 'admin')->paginate(10)
        ]);
    }

    public function update(Request $request, User $user)
    {
        match ($request->status) {
            'activate' => $user->update(['is_activated' => true]),
            'deactivate' => $user->update(['is_activated' => false]),
        };

        Mail::to($user)->send(new AccountUpdate(user: $user, option: $request->status));// notify email

        return back()->with('success', "User Account $request->status Successfully");
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', "User Account Deleted Successfully");
    }
}