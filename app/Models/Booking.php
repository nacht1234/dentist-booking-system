<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{  // app/Models/Booking.php

    protected $fillable = [
        'user_id',
        'schedule_id',
        'status',
        // add other fillable fields if any
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function dentist()
    {
        return $this->hasOneThrough(
            \App\Models\Dentist::class,
            \App\Models\Schedule::class,
            'id',          // Schedule's primary key
            'id',          // Dentist's primary key
            'schedule_id', // Booking's foreign key to Schedule
            'dentist_id'   // Schedule's foreign key to Dentist
        );
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

}
