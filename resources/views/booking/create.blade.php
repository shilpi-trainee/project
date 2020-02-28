<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="{{asset('css/form.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

</head>

<body>

  <!-- <h1>Booking Form</h1> -->

  <div class="container solid" id="form" align="center">

    <form class="well form-horizontal" action="{{route('booking.store')}}" method="post" id="contact_form">

      <!-- <form action="{{route('booking.store')}}" method="post"> -->
      <fieldset>

        <!-- Form Name -->
        <div>
          <legend class="dashed">Booking Form Today!</legend>
        </div>
        <br>
        @csrf

        <div class="input-container">
          <i class="fa fa-user icon">:Name</i>
          <input type="text" class="col-sm-3 input-field form-control control-label" placeholder="Name" autocomplete="off" name="booking_name">
          @if ($errors->has('booking_name'))
          <span class="text-danger">{{ $errors->first('booking_name') }}</span>
          @endif
        </div>

        <div class="input-container">
          <i class="fa fa-envelope icon">:Email</i>
          <input type="email" class="col-sm-3 input-field form-control control-label" autocomplete="off" name="booking_email" placeholder="Email">
          @if ($errors->has('booking_email'))
          <span class="text-danger">{{ $errors->first('booking_email') }}</span>
          @endif
        </div>

        <div class="input-container">
          <i class="fa fa-calendar icon" aria-hidden="true">:Start Date</i>
          <input type="text" class="col-sm-3 input-field form-control control-label" id="first" autocomplete="off" value="@if(session()->get('start_date')){{session('start_date')}}@endif" readonly autocomplete="off" name="start_date">
          <!-- @if ($errors->has('start_date'))
          <span class="text-danger">{{ $errors->first('start_date') }}</span>
          @endif -->
        </div>

        <div class="input-container">
          <i class="fa fa-calendar icon">:End Date</i>
          <input type="text" id="second" class="col-sm-3 input-field form-control control-label" autocomplete="off" value="@if(session()->get('end_date')){{session('end_date')}}@endif" name="end_date" readonly required>
          <!-- @if ($errors->has('end_date'))
          <span class="text-danger">{{ $errors->first('end_date') }}</span>
          @endif -->
        </div>
        <div class="input-container">
          <i class="fa fa-inr icon" aria-hidden="true">:Amount</i>
          <input type="text" class="col-sm-3 form-control input-field control-label " autocomplete="off" id="booking_amount" value="@if(session()->get('booking_amount')){{session('booking_amount')}}@endif" name="booking_amount" readonly>
        </div>
        <br>
        <div class="input-container">
          <button type="submit" class="col-sm-3 form-control input-field control-label btn btn-warning" name="submit">Send<span class="glyphicon glyphicon-send"></span></button>
        </div>
    </form>
  </div>
  <br><br>
  @if(session()->get('success')){{session('success')}}@endif
  @if($errors->any())
  <div>
    <ul>
      @foreach($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <script type="text/javascript">
    $(document).ready(function() {
      $("#first").change(function() {
        dayDiff($('#first').val(), $('#second').val());
      });
    });

    function dayDiff(firstDate, secondDate) {
      firstDate = new Date(firstDate);
      secondDate = new Date(secondDate);
      if (!isNaN(firstDate) && !isNaN(secondDate)) {
        firstDate.setHours(0, 0, 0, 0); //ignore time part
        secondDate.setHours(0, 0, 0, 0); //ignore time part
        var dayDiff = secondDate - firstDate;
        dayDiff = dayDiff / 86400000; // divide by milisec in one day
        console.log(dayDiff);
        //alert(dayDiff);

        var total = dayDiff * 500;
        // alert(total);
        if (total > 10000) {
          var lastval = (total * 10) / 100;
          console.log(lastval);
          alert(lastval);
        } else {
          var lastval = (total * 5) / 100;
          console.log(lastval);
          alert(lastval);
        }
        var mytotal = total + lastval;
        console.log(mytotal);
        $("#booking_amount").val(mytotal);
      } else {
        //console.log("Enter valid date.");
      }
    }
  </script>
</body>

</html>