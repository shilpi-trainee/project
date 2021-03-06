<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Mail;
use DateTime;
use App\Booking;
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
        //$data = Booking::all('start_date','end_date')->toArray();
        $data = Booking::select(DB::raw('date(start_date) as start_date,date(end_date) as end_date'))
            ->where("start_date", "!=", NULL)->orWhere("end_date", "!=", NULL)
            ->havingRaw("CAST(`start_date` AS CHAR(10)) != 0")->havingRaw("CAST(`end_date` AS CHAR(10)) != 0")->get()->toArray();
        return view('booking.index', ['data' => $data]);
        //return view('booking.index');
    }

    public function getdates()
    {
        $data = Booking::all('start_date', 'end_date')->toArray();
        return json_encode($data);
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
            'booking_name'   => 'required',
            'booking_email'  => 'required|email',
            'start_date'     => 'required|date',
            'end_date'       => 'required|after:start_date',
            // 'total'          => 'required|numeric'
        ]);

        // Author:shilpitrivedi,
        // purpose:get data from database,
        // Date:25/02/2020,
        // parameters:

        $booking_name = $request->get('booking_name');
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');



        // function dayDiff(firstDate, secondDate) {
        //     firstDate = new Date(firstDate);
        //     secondDate = new Date(secondDate);
        //     if (!isNaN(firstDate) && !isNaN(secondDate)) {
        //       firstDate.setHours(0, 0, 0, 0); //ignore time part
        //       secondDate.setHours(0, 0, 0, 0); //ignore time part
        //       var dayDiff = secondDate - firstDate;
        //       // console.log(dayDiff);
        //       dayDiff = dayDiff / 86400000; // divide by milisec in one day
        //       console.log(dayDiff);


        $datetime1 = new DateTime($start_date);
        $datetime2 = new DateTime($end_date);
        $interval = $datetime1->diff($datetime2);
        // dd($interval);
        $days = $interval->format('%a');
        $total = $days * 500;
        if ($total > 10000) {
            $final_total = $total * 10 / 100;
            $total = $total + $final_total;
        } else {
            $final_total = $total * 5 / 100;
            $total = $total + $final_total;
        }

        $percentage_tax = $final_total;
        $booking_email = $request->get('booking_email');

        $start_date1 = date('d-m-Y', strtotime($start_date));
        $end_date1 = date('d-m-Y', strtotime($end_date));
        session()->put('total', $total);
        // Author:shilpitrivedi,
        // purpose:Email sending,
        // Date:25/02/2020,
        // parameters:
        $email = $booking_email;
        $to_name = $booking_name;
        $to_email = $email;

        $data = array('name' => "$booking_name", 'booking_email' => "$booking_email", 'start_date' => "$start_date", 'end_date' => "$end_date", 'Percentage_of_tax_rupees' => "$percentage_tax", 'amount' => "$total", 'No_of_days' => "$days");

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
                'total' => $total,
                'percantage_tax'  => $percentage_tax,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'booking_email' => $booking_email
            ]
        );
        return redirect('booking')->with('success', 'Thank You For Your Booking Your Starting Date Is From ' . $start_date . ' To Ending Date ' . $end_date . ' Tax Of Rupees Is ' . $percentage_tax . ' Total Amount Is ' . $total . ' Hope You Will Enjoy Your Days');
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
