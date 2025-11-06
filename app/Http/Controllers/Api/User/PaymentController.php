<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Job;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|exists:booking,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $user = auth()->user();
            $booking = Booking::with(['service', 'cleaner.services', 'reviews'])->findOrFail($request->booking_id);
            $finalAmount = $booking->total_amount;

            $reviewRating = $booking->reviews->avg('rating') ?? null;
            $cleanerServices = $booking->cleaner->services->where('id', $booking->service_id)->values()->first();


            $cleanerServices = $booking->cleaner->services->where('id', $booking->service_id)->values()->first();
            $result = $cleanerServices->pivot->price ?? null;

            if ($finalAmount <= 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid booking amount',
                ], 400);
            }

            $finalAmountInCents = intval($finalAmount * 100);
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $paymentIntent = PaymentIntent::create([
                'amount' => intval($finalAmount * 100),
                'currency' => 'usd',
                'metadata' => [
                    'user_id' => $user->id,
                    'booking_id' => $booking->id,
                    'date' => $booking->date,
                    'time' => $booking->time,
                    'reviews_rating' => $reviewRating,
                    'duration' => $booking->service->max_duration,
                    'duration_unit' => $booking->service->duration_unit,
                    'address' => $booking->address,
                    'service' => $booking->service->name,
                    'cleaner_name' => $booking->cleaner->name,
                    'service_fee' => $cleanerServices->pivot->price ?? null,
                    'experience_year' => $booking->cleaner->experience_year,
                    'discount_value' => $booking->discount_value,
                    'cleaner_services' => json_encode($cleanerServices->name),
                ],
            ]);

            return response()->json([
                'status' => true,
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent_id' => $paymentIntent->id,
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Server error',
                'errors' => [$ex->getMessage()],
            ], 500);
        }
    }

    public function paymentConfirmation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_intent_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $paymentIntentId = $request->input('payment_intent_id');
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
            $status = $this->mapPaymentIntentStatusToDatabaseStatus($paymentIntent->status);

            $cleanerServices = json_decode($paymentIntent->metadata->cleaner_services ?? '[]', true);
            $bookingId = $paymentIntent->metadata->booking_id;
            $booking = Booking::with(['service', 'cleaner.services', 'reviews'])->findOrFail($bookingId);

            $cleanerServices = $booking->cleaner->services->map(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'price' => $service->pivot->price,
                    'duration' => $service->pivot->duration_minutes,
                    'duration_unit' => $service->duration_unit,
                ];
            })->values()->toArray();

            $payment = Payment::updateOrCreate(
                ['stripe_payment_intent_id' => $paymentIntent->id],
                [
                    'user_id' => $paymentIntent->metadata->user_id,
                    'booking_id' => $paymentIntent->metadata->booking_id,
                    'amount' => $paymentIntent->amount / 100,
                    'payment_status' => $status,
                    'currency' => 'usd',
                    'payment_method' => 'Stripe',
                ]
            );

            return response()->json([
                'status' => true,
                'message' => 'Payment status updated',
                'payment' => $payment,
                'meta' => [
                    'service' => $paymentIntent->metadata->service ?? null,
                    'duration' => $paymentIntent->metadata->duration ?? null,
                    'duration_unit' => $paymentIntent->metadata->duration_unit ?? null,
                    'date' => $paymentIntent->metadata->date ?? null,
                    'time' => $paymentIntent->metadata->time ?? null,
                    'address' => $paymentIntent->metadata->address ?? null,
                    'cleaner_name' => $paymentIntent->metadata->cleaner_name ?? null,
                    'cleaner_services' => $cleanerServices,
                    'discount_value' => $paymentIntent->metadata->discount_value ?? null,
                    'service_fee' => $paymentIntent->metadata->service_fee ?? null,
                    'experience_year' => $paymentIntent->metadata->experience_year ?? null,
                    'rating' => $paymentIntent->metadata->reviews_rating ?? null,
                ],
            ], 200);

        } catch (\Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => 'Server error',
                'errors' => [$ex->getMessage()],
            ], 500);
        }
    }

    private function mapPaymentIntentStatusToDatabaseStatus($stripeStatus)
    {
        switch ($stripeStatus) {
            case 'succeeded':
                return 'paid';
            case 'requires_payment_method':
            case 'requires_confirmation':
            case 'requires_action':
                return 'unpaid';
            case 'canceled':
            case 'requires_capture':
                return 'failed';
            default:
                return 'failed';
        }
    }
}
