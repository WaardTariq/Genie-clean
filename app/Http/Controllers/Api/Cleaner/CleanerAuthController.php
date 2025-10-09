<?php

namespace App\Http\Controllers\Api\Cleaner;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Cleaner;
use App\Models\PasswordReset;
use App\Models\service;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\CleanerResetOtp;

class CleanerAuthController extends Controller
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
            $user = new Cleaner();
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
            'email' => 'required|email|exists:cleaners,email',
            'password' => 'required',
            'device_token' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => $validator->errors()->all()], 422);
        }

        try {
            // find cleaner by email
            $cleaner = Cleaner::where('email', $request->email)->first();

            // check password
            if (!$cleaner || !Hash::check($request->password, $cleaner->password)) {
                return response()->json(['status' => false, 'message' => 'Invalid credentials'], 401);
            }

            // save device token if provided
            if ($request->filled('device_token')) {
                $cleaner->device_token = $request->device_token;
                $cleaner->save();
            }

            // create sanctum token
            $token = $cleaner->createToken('cleaner-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'token' => $token,
                'data' => $cleaner
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }


    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:cleaners,email',
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
            $cleaner = Cleaner::where('email', $email)->first();

            if ($cleaner) {
                PasswordReset::where('email', $request->email)->delete();

                PasswordReset::create([
                    'email' => $request->email,
                    'token' => $otp,
                    'created_at' => now(),
                ]);

                Mail::to($cleaner->email)->send(new CleanerResetOtp($otp));
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
            $cleaner = Cleaner::where('email', $request->email)->first();
            if (!$cleaner) {
                return response()->json(['status' => false, 'message' => 'Email not found'], 400);
            }

            $cleaner->password = Hash::make($request->password);
            $cleaner->save();

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

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'zone_id' => 'required|exists:zones,id',
            'experience_year' => 'required|integer|min:0',
            'phone' => 'required|string|max:20',
            'services' => 'nullable|array',
            'services.*.service_id' => 'required|exists:services,id',
            'services.*.price' => 'required|numeric|min:0',
            'services.*.duration_minutes' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => $validator->errors()], 422);
        }

        try {
            $cleaner = auth('cleaners')->user();

            $cleaner->name = $request->name;
            $cleaner->experience_year = $request->experience_year;
            $cleaner->phone = $request->phone;

            if ($request->hasFile('image')) {
                $cleaner->image = Helpers::customUpload('cleaner-image', $request->image);
            }

            $cleaner->save();

            if ($request->has('zone_id')) {
                $cleaner->zones()->syncWithoutDetaching([$request->zone_id]);
            }

            if ($request->filled('services')) {
                $syncData = [];

                foreach ($request->services as $serviceInput) {
                    $service = service::find($serviceInput['service_id']);

                    if (!$service) {
                        return response()->json(['status' => false, 'message' => 'Invalid service selected'], 400);
                    }

                    if (
                        isset($service->min_price, $service->max_price) &&
                        ($serviceInput['price'] < $service->min_price || $serviceInput['price'] > $service->max_price)
                    ) {
                        return response()->json([
                            'status' => false,
                            'message' => "Price for {$service->name} must be between {$service->min_price} and {$service->max_price}"
                        ], 400);
                    }

                    if (
                        isset($service->min_duration, $service->max_duration) &&
                        ($serviceInput['duration_minutes'] < $service->min_duration_minutes ||
                            $serviceInput['duration_minutes'] > $service->max_duration_minutes)
                    ) {
                        return response()->json([
                            'status' => false,
                            'message' => "Duration for {$service->name} must be between {$service->min_duration_minutes} and {$service->max_duration_minutes} minutes"
                        ], 400);
                    }

                    $syncData[$service->id] = [
                        'price' => $serviceInput['price'],
                        'duration_minutes' => $serviceInput['duration_minutes']
                    ];
                }

                // ✅ Attach valid data
                $cleaner->services()->syncWithoutDetaching($syncData);
            }

            return response()->json(['status' => true, 'message' => 'Profile Updated Successfully'], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something Went Wrong: ' . $e->getMessage()
            ], 500);
        }
    }


    public function getZones()
    {
        try {
            $zones = Zone::where('status', 1)->get();
            return response()->json(['status' => true, 'message' => 'Zones Fetched Successfully', 'data' => $zones], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went Wrong' . $e->getMessage()], 500);
        }

    }

}
