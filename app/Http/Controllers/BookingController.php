<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function bookingList()
    {
        $bookings = Job::with(['promoCodeUsages', 'service', 'cleaner', 'user'])->get();
        return view('admin.booking.list', compact('bookings'));
    }


}
