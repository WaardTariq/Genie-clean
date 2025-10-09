<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userList()
    {
        $users = User::where('is_admin', 0)->get();
        return view('admin.users.all', compact('users'));
    }
}
