<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'dentist', 'schedule'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('staff.bookings.index', compact('bookings'));
    }

    public function confirm(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking already confirmed.');
        }

        $booking->update(['status' => 'confirmed']);

        return back()->with('success', 'Booking confirmed successfully.');
    }
}

