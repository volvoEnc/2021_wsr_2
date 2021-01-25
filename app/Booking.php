<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'flight_from', 'flight_back',
        'date_from', 'date_back',
        'code'
    ];


}
