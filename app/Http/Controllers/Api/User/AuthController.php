<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\UserResetOtp;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => $validator->errors()], 422);
        }

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['status' => true, 'message' => 'User Register Successfully', 'data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went Wrong' . $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            'device_token' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                // Prevent admin from logging in via this method
                if ($user->is_admin == 1) {
                    Auth::logout();
                    return response()->json(['status' => false, 'message' => 'Incorrect Email or Password'], 400);
                }

                // Store device_token if provided
                if ($request->filled('device_token')) {
                    $user->device_token = $request->device_token;
                    $user->save();
                }

                $token = $user->createToken('user-token')->plainTextToken;

                return response()->json([
                    'status' => true,
                    'message' => 'Login successful',
                    'token' => $token,
                    'data' => $user
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            $otp = rand(1000, 9999);
            $email = $request->email;
            $user = User::where('email', $email)->first();

            if ($user) {
                PasswordReset::where('email', $request->email)->delete();

                PasswordReset::create([
                    'email' => $request->email,
                    'token' => $otp,
                    'created_at' => now(),
                ]);

                Mail::to($user->email)->send(new UserResetOtp($otp));
                return response()->json([
                    'status' => true,
                    'message' => 'OTP sent to your email.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went Wrong' . $e->getMessage()], 500);
        }
    }

    public function otpVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:password_resets,email',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            $resetEntry = PasswordReset::where('email', $request->email)
                ->where('token', $request->otp)
                ->first();

            if ($resetEntry) {
                return response()->json([
                    'status' => true,
                    'message' => 'OTP verified. You may now reset your password.',
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Incorrect OTP.',
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()->all()], 422);
        }

        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json(['status' => false, 'message' => 'Email not found'], 400);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            PasswordReset::where('email', $request->email)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Password changed successfully. You can now log in.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function logout()
    {
        try {
            $supervisor = auth()->user()->id;

            if ($supervisor && $supervisor->currentAccessToken()) {
                $supervisor->currentAccessToken()->delete();
            }

            return response()->json([
                'status' => true,
                'message' => 'Logout successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            $user = auth()->user();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized',
                ], 401);
            }

            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Old password is incorrect.',
                ], 400);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Password changed successfully.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }


}
