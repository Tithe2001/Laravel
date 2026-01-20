<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telemedicine extends Model
{

    protected $table = 'appointments';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'specialist',
        'doctor',
        'appointment_date',
        'appointment_time',
    ];


public function doctor()
{
    return $this->belongsTo(Doctor::class);
}

}
