<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dentist;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Booking;


class DentistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dentists = Dentist::all();
        return view('admin.dentists.index', compact('dentists'));
    }

    public function create()
    {
        return view('admin.dentists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:dentists',
            'specialization' => 'required',
        ]);

        Dentist::create($request->all());

        return redirect()->route('admin.dentists.index')->with('success', 'Dentist created.');
    }

    public function edit(Dentist $dentist)
    {
        return view('admin.dentists.edit', compact('dentist'));
    }

    public function update(Request $request, Dentist $dentist)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:dentists,email,' . $dentist->id,
            'specialization' => 'required',
        ]);

        $dentist->update($request->all());

        return redirect()->route('admin.dentists.index')->with('success', 'Dentist updated.');
    }

    public function destroy(Dentist $dentist)
    {
        $dentist->delete();

        return redirect()->route('admin.dentists.index')->with('success', 'Dentist deleted.');
    }
}
