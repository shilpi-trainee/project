<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class MyController extends Controller
{

    public function check(Request $request)
    {
        // dd($request)->toArray();
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
            //->where('booking_name', $booking_name)
            ->get();

        $booking = DB::table('tbl_booking')
            ->where('start_date', '>=', $start_date)
            ->where('end_date', '<=', $end_date)
            ->get();

        $count = $booking->count();
     
        if ($count > 0) {
// dd($count);
            /*$result['success'] = 1;
            $result['is_available'] = 0;
            $result['message'] = 'Sorry These Dates Are Booked from';*/
            
            return redirect('booking')->with('success', 'Sorry These Dates Are Booked from ' . $booking_name . ' starting date ' . $start_date . ' ending date ' . $end_date);
            dd("hii");
        } else {
            session()->put('start_date', $start_date);
            session()->put('end_date', $end_date);
            session()->put('total', $total);

            /*$result['success'] = 1;
            $result['is_available'] = 1;
            $result['message'] = 'booking available';*/
            $result = 1;
            return json_encode($result);

            Session::flush();
        }
    }
    public function deleteSessionData(Request $request)
    {
        $request->session()->forget('start_date');
        $request->session()->forget('end_date');
    }
}
