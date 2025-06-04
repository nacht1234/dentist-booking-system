<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Dentist;
use App\Models\Schedule;


class BookingController extends Controller
{
    public function index()
    {
        // Show only confirmed bookings
        $bookings = Booking::with(['user', 'dentist', 'schedule'])
            ->where('status', 'confirmed')
            ->latest()
            ->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }
}
