<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Mail;
use DateTime;
use SebastianBergmann\Environment\Console;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('booking.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validation

        $validation = $request->validate([
            'booking_name' => 'required',
            'booking_email' => 'required|email'
        ]);

        // Author:shilpitrivedi,
        // purpose:get data from database,
        // Date:25/02/2020,
        // parameters:

        $booking_name = $request->get('booking_name');
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        // $percentage_tax = $request->get('percentage_tax');
        $booking_email = $request->get('booking_email');
        $booking_amount = $request->get('booking_amount');


        $start_date1 = date('d-m-Y', strtotime($start_date));
        $end_date1 = date('d-m-Y', strtotime($end_date));

        // Author:shilpitrivedi,
        // purpose:Email sending,
        // Date:25/02/2020,
        // parameters:

        $message_new = "Name :$booking_name, Email : $booking_email, Start Date: $start_date1, End Date: $end_date1, Amount: $booking_amount";
        $email = $booking_email;
        $to_name = $booking_name;
        $to_email = $email;
        $data = array('name' => "$booking_name", "body" => "$message_new");

        Mail::send('emails.mail', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('Inquiry From Booking');
            $message->from('crazydev82@gmail.com', 'Booking');
        });

        // Author:shilpitrivedi,
        // purpose:Insert data,
        // Date:25/02/2020,
        // parameters

        DB::table('tbl_booking')->insert(
            [
                'booking_name' => $booking_name,
                'booking_amount' => $booking_amount,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'booking_email' => $booking_email
            ]
        );
        return redirect('booking')->with('success', 'Your Booking Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
