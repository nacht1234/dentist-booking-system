<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Dentist;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with('dentist')->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $dentists = Dentist::all();
        return view('admin.schedules.create', compact('dentists'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dentist_id' => 'required|exists:dentists,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        $validated['start_time'] = Carbon::parse($validated['start_time']);
        $validated['end_time'] = Carbon::parse($validated['end_time']);

        Schedule::create($validated);

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule created.');
    }

    public function edit(Schedule $schedule)
    {
        $dentists = Dentist::all();
        return view('admin.schedules.edit', compact('schedule', 'dentists'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'dentist_id' => 'required|exists:dentists,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule updated.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule deleted.');
    }
}
