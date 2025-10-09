<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function bookingList()
    {
        $bookings = Job::with(['promoCode', 'service', 'cleaner', 'user'])->get();
        return view('admin.booking.list', compact('bookings'));
    }

    public function bookingDetail($id)
    {
        $booking = Job::with(['promoCode', 'service', 'cleaner', 'user'])->findOrFail($id);
        return view('admin.booking.detail', compact('booking'));
    }


}
