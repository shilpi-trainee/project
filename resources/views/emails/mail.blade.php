{{-- Hi <strong>{{ $name }}</strong>, --}}

<strong>Booking Details</strong>
<br>
<br>
<table border="1" bgcolor="yellow">
    <tr>
        <th>Booking Name:</th>
        <th>Email:</th>
        <th>Start Date:</th>
        <th>End Date:</th>
        <th>Amount:</th>
        <th>Percentage_of_tax_rupees:</th>
        <th>Total_no_of_days:</th>
    </tr>
    <tr>
        <td>{{$name}}</td>
        <td>{{$booking_email}}</td>
        <td>{{$start_date}}</td>
        <td>{{$end_date}}</td>
        <td>{{$amount}}</td>
        <td>{{$Percentage_of_tax_rupees}}</td>
        <td>{{$No_of_days}}</td>
    </tr>
</table>