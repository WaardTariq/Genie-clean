<?php

namespace App\Http\Controllers;

use App\CentralLogics\Helpers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginIndex(Request $request)
    {
        return view('admin.Auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->is_admin == 1) {
                return redirect()->intended(route('dashboard'))->with('modal-success', 'Login Successful');
            }

            Auth::logout();
            return redirect()->back()->with('modal-danger', 'Access denied. You are not an admin.');
        }

        return back()->with('modal-danger', 'The provided credentials do not match our records.')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginIndex')->with('modal-success', 'You have been logged out successfully.');
    }

    public function editProfile(Request $request)
    {
        $profile = User::findOrFail(auth()->id());
        return view('admin.auth.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $profile = User::findOrFail(auth()->id());
        if ($request->has('name')) {
            $profile->name = $request->name;
        }
        if ($request->has('address')) {
            $profile->address = $request->address;
        }
        if ($request->has('phone')) {
            $profile->phone = $request->phone;
        }
        if ($request->has('image')) {
            $profile->image = Helpers::customUpload('user-image', $request->image);
        }
        $profile->save();
        return redirect()->back()->with('modal-success','Profile Updated Successfully');
    }


}
