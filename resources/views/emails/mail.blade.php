{{-- Hi <strong>{{ $name }}</strong>, --}}

<strong>Booking Details</strong>
<br>
<br>
<table border="1">
    <tr>
        <th>Booking Name:</th>
        <th>Email:</th>
        <th>Start Date:</th>
        <th>End Date:</th>
        <th>Amount:</th>
        <th>Percentage_of_tax_rupees:</th>
    </tr>
    <tr>
        <td>{{$name}}</td>
        <td>{{$booking_email}}</td>
        <td>{{$start_date}}</td>
        <td>{{$end_date}}</td>
        <td>{{$amount}}</td>
        <td>{{$Percentage_of_tax_rupees}}</td>
    </tr>
</table>