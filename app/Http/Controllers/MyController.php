<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class MyController extends Controller
{

    public function check(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'start_date'    =>  'required|date',
            'end_date'      =>  'required|after:start_date'
        ]);

        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $booking_name = $request->get('booking_name');
        $total = $request->get('total');
        DB::enableQueryLog();

        $bookedUser = DB::table('tbl_booking')->select('start_date', 'end_date', 'booking_name')
            ->where('start_date', $start_date)
            ->where('end_date', $end_date)
            ->where('booking_name', $booking_name)
            ->get();
        // print_r($bookedUser);
        // die();


        $booking = DB::table('tbl_booking')
            ->where('start_date', '<=', $start_date)
            ->where('end_date', '>=', $end_date)

            ->get();

        $count = $booking->count();

        //echo $count;

        if ($count > 0) {
            return redirect('booking')->with('success', 'Sorry These Dates Are Booked from ' . $booking_name . ' starting date ' . $start_date . ' ending date ' . $end_date);
        } else {
            session()->put('start_date', $start_date);
            session()->put('end_date', $end_date);
            session()->put('total', $total);

            return redirect('booking/create');
        }
    }
}