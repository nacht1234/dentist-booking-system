<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Dentist;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['dentist', 'schedule'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('client.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $dentists = \App\Models\Dentist::with(['schedules'])->get();

        foreach ($dentists as $dentist) {
            $dentist->availableSchedules = $dentist->schedules->filter(function ($schedule) {
                // Check if any booking exists for this schedule with status pending or confirmed
                return !Booking::where('schedule_id', $schedule->id)
                    ->whereIn('status', ['pending', 'confirmed'])
                    ->exists();
            });
        }

        return view('client.bookings.create', compact('dentists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
        ]);

        // Only check by schedule_id, no dentist_id here
        $alreadyBooked = Booking::where('schedule_id', $request->schedule_id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($alreadyBooked) {
            return back()->withErrors(['schedule_id' => 'This slot is already booked.'])->withInput();
        }

        Booking::create([
            'user_id' => Auth::id(),
            'schedule_id' => $request->schedule_id,
            'status' => 'pending',
        ]);

        return redirect()->route('client.bookings.index')->with('success', 'Booking request submitted!');
    }
}
