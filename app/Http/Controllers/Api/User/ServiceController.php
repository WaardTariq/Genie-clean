<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Booking;
use App\Models\Cleaner;
use App\Models\Job;
use App\Models\PromoCode;
use App\Models\PromoCodeUsages;
use App\Models\service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function getServices()
    {
        try {
            $services = service::where('status', 1)->get();

            return response()->json(['status' => true, 'message' => 'Services Fetched Successfully', 'data' => $services], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'messaege' => 'Something Went Wrong' . $e->getMessage()], 500);
        }
    }

    public function getServiceDetail(Request $request)
    {
        try {
            $serviceId = $request->query('service_id');
            $service = service::where('id', $serviceId)->where('status', 1)->first();
            return response()->json(['status' => true, 'message' => 'Service Detail Fetched Successfully', 'data' => $service], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went Wrong' . $e->getMessage()], 500);
        }
    }

    public function filterCleaner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'address' => 'required',
            'zone_id' => 'required|exists:zones,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            $date = $request->date;
            $time = $request->time;
            $zoneId = $request->zone_id;

            $cleaners = Cleaner::whereHas('zones', function ($q) use ($zoneId) {
                $q->where('zones.id', $zoneId);
            });

            $availableCleaners = $cleaners->whereDoesntHave('jobs', function ($q) use ($date, $time) {
                $q->where('date', $date)->where('time', $time);
            })->get();

            if ($availableCleaners->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'No cleaners available for the selected date and time'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Available cleaners fetched successfully',
                'data' => $availableCleaners
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function createBooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'address' => 'required|string',
            'cleaner_id' => 'required|exists:cleaners,id',
            'service_id' => 'required|exists:services,id',
            'zone_id' => 'required|exists:zones,id',
            'promo_code' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => $validator->errors()->all()], 422);
        }

        DB::beginTransaction();
        try {
            $user = auth()->user();
            $service = Service::findOrFail($request->service_id);
            $cleaner = Cleaner::findOrFail($request->cleaner_id);
            $service = $cleaner->services()->where('service_id', $request->service_id)->first();
            if (!$service) {
                return response()->json(['status' => false, 'message' => 'Cleaner does not provide this service'], 400);
            }

            $base_price = $service->pivot->price;
            $discount = 0;
            $total_amount = $base_price;

            if ($request->filled('promo_code')) {
                $promo = PromoCode::where('code', $request->promo_code)->where('status', 1)->first();

                if (!$promo) {
                    return response()->json(['status' => false, 'message' => 'Invalid promo code'], 400);
                }

                $now = now();
                if (
                    ($promo->starts_at && $now->lt($promo->starts_at)) ||
                    ($promo->expires_at && $now->gt($promo->expires_at))
                ) {
                    return response()->json(['status' => false, 'message' => 'Promo code expired or not active'], 400);
                }

                if ($promo->usage_limit && $promo->usages()->count() >= $promo->usage_limit) {
                    return response()->json(['status' => false, 'message' => 'Promo code usage limit reached'], 400);
                }

                if ($promo->per_user_limit && $promo->usages()->where('user_id', $user->id)->count() >= $promo->per_user_limit) {
                    return response()->json(['status' => false, 'message' => 'You have already used this promo code maximum times'], 400);
                }

                if ($promo->min_order_amount && $base_price < $promo->min_order_amount) {
                    return response()->json(['status' => false, 'message' => 'Minimum order amount not reached for this promo'], 400);
                }

                if ($promo->discount_type === 'fixed') {
                    $discount = $promo->discount_value;
                } else {
                    $discount = ($base_price * $promo->discount_value) / 100;
                }

                $total_amount = max($base_price - $discount, 0);
            }

            $booking = new Booking();
            $booking->user_id = $user->id;
            $booking->cleaner_id = $cleaner->id;
            $booking->service_id = $service->id;
            $booking->zone_id = $request->zone_id;
            $booking->date = $request->date;
            $booking->time = $request->time;
            $booking->address = $request->address;
            $booking->total_amount = $total_amount;
            $booking->promo_code_id = $promo?->id ?? null;
            $booking->status = 'pending';
            $booking->discount_value = $promo->discount_value;
            $booking->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Booking created successfully',
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }



}
