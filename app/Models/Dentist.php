<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dentist extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'name',
        'email',
        'specialization',
        'phone',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    // public function appointments()
    // {
    //     return $this->hasMany(Appointment::class);
    // }
}
