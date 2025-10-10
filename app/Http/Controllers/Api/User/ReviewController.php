<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function createReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|exists:booking,id',
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => $validator->errors()], 422);
        }

        try {

            $booking = Job::findOrFail($request->booking_id);

            $alreadyReviewed = Reviews::where('booking_id', $booking->id)
                ->where('user_id', auth()->id())
                ->exists();

            if ($alreadyReviewed) {
                return response()->json([
                    'status' => false,
                    'message' => 'You have already reviewed this booking.',
                ], 400);
            }

            $review = new Reviews();
            $review->booking_id = $booking->id;
            $review->cleaner_id = $booking->cleaner_id;
            $review->user_id = auth()->id();
            $review->rating = $request->rating;
            $review->comment = $request->comment;
            $review->save();
            return response()->json(['status' => true, 'message' => 'Review Stored Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went Wrong' . $e->getMessage()], 500);
        }
    }

    public function getReviews()
    {
        try {
            $reviews = Reviews::with('job')->where('user_id', auth()->id())->get();
            return response()->json(['status' => true, 'message' => 'Reviews Fetched Successfully', 'data' => $reviews], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Something Went Wrong' . $e->getMessage()], 500);
        }
    }
}
