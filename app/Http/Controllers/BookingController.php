<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function bookingList()
    {
        $bookings = Booking::with(['promoCode', 'service', 'cleaner', 'user'])->get();
        return view('admin.booking.list', compact('bookings'));
    }

    public function bookingDetail($id)
    {
        $booking = Booking::with(['promoCode', 'service', 'cleaner.services', 'user'])->findOrFail($id);
        return view('admin.booking.detail', compact('booking'));
    }

    public function unassignCleaner($id)
    {
        try {
            $booking = Booking::findOrFail($id);

            if (!$booking->cleaner_id) {
                return redirect()->back()->with('modal-danger', 'Cleaner is not assigned');
            }

            // Unassign the cleaner
            $booking->cleaner_id = null;
            $booking->save();

            return redirect()->back()->with('modal-success', 'Cleaner UnAssign Successfully, Now You can assign new Cleaner');

        } catch (\Exception $e) {
            return redirect()->back()->with('modal-danger', 'Something Went Wrong' . $e->getMessage());
        }
    }


}
