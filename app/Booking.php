<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'tbl_booking';
    protected $fillable = ['booking_name', 'booking_email','start_date','end_date'];
}
