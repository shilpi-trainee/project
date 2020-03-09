<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'tbl_booking';
    protected $fillable = ['booking_name', 'booking_email','start_date','end_date'];

public static function getDataFilter($id){
    $product_Data = Booking::select()
    ->with('start_date')
    ->with('end_date')
    ->where('total')
    ->get()
    ->toarray();
    return $product_Data;
}



}