<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/form.css')}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/jquery.datetimepicker.full.js') }}"></script>
</head>

<body>
  <div class="container solid add_form" id="form">
    <h2 class="dashed" align="center">Booking Date</h2>
    <br>
    @if(!isset($a))
    <form action="{{URL::to('/bookingcheck')}}" id="addform" method="post" >
      @csrf
      <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          Start Date :<input type="text" class="col-sm-3 form-control control-label start-date datepicker" id="first" autocomplete="off" name="start_date" >
          @if ($errors->has('start_date'))
          <span class="text-danger">{{ $errors->first('start_date') }}</span>
          @endif
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          End Date : <input type="text" class="col-sm-3 form-control control-label end-date" id="second" autocomplete="off" name="end_date" >
          @if ($errors->has('end_date'))
          <span class="text-danger">{{ $errors->first('end_date') }}</span>
          @endif
        </div>
      </div>
      <input type="hidden" name="total" value="@if(session()->get('total')){{session('total')}}@endif" id="total">
      <br><br>
    </div>
      <br>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <input type="submit" id="submit" class="btn btn-primary" name="submit">
        </div>
      </div>
      <br><br><br>
  </div>
  @if(session()->get('success')){{session('success')}}@endif
  </form>
  @endif

  @if (isset($a))
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
          @if ($errors->has('start_date'))
          <span class="text-danger">{{ $errors->first('start_date') }}</span>
          @endif
        </div>

        <div class="input-container">
          <i class="fa fa-calendar icon">:End Date</i>
          <input type="text" id="second" class="col-sm-3 input-field form-control control-label" autocomplete="off" value="@if(session()->get('end_date')){{session('end_date')}}@endif" name="end_date" readonly required>
          @if ($errors->has('end_date'))
          <span class="text-danger">{{ $errors->first('end_date') }}</span>
          @endif
        </div>
        <div class="input-container">
          <i class="fa fa-inr icon" aria-hidden="true">:Amount(Fix amount was with 500(if your total bill was >10000 the tax will be apply as a 10% or else tax will be apply as a 5%))</i>
          <input type="text" class="col-sm-3 form-control input-field control-label " autocomplete="off" id="total" value="@if(session()->get('total')){{session('total')}}@endif" name="total" readonly>
          @if ($errors->has('total'))
          <span class="text-danger">{{ $errors->first('total') }}</span>
          @endif
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

@endif



  <!-- <div class="fetchproductData">
    @include('booking/create')
</div> -->
 
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
      $("#second").change(function() {
        dayDiff($('#first').val(), $('#second').val());
      });
    });

    // Author:shilpitrivedi,
    // purpose:Difference between two dates,calculation of price,
    // Date:25/02/2020,
    // parameters:

    function dayDiff(firstDate, secondDate) {
      firstDate = new Date(firstDate);
      secondDate = new Date(secondDate);
      if (!isNaN(firstDate) && !isNaN(secondDate)) {
        firstDate.setHours(0, 0, 0, 0); //ignore time part
        secondDate.setHours(0, 0, 0, 0); //ignore time part
        var dayDiff = secondDate - firstDate;
        // console.log(dayDiff);
        dayDiff = dayDiff / 86400000; // divide by milisec in one day
        console.log(dayDiff);
        //alert(dayDiff);

        var total = dayDiff * 500;
        // alert(total);
        if (total > 10000) {
          var lastval = (total * 10) / 100;
          console.log(lastval);
          // alert(lastval);
        } else {
          var lastval = (total * 5) / 100;
          console.log(lastval);
          // alert(lastval);
        }
        var mytotal = total + lastval;
        console.log(mytotal);
        $("#total").val(mytotal);
      } else {
        //console.log("Enter valid date.");
      }

    }
  </script>

  <!-- DatePicker -->

  <script>
    $("#first").datetimepicker({
      timepicker: false,
      format: "Y-m-d"
    });

    $("#second").datetimepicker({
      timepicker: false,
      format: "Y-m-d"
    });
  </script>
  <!-- DatePicker -->
  <script>
      $(function() {
        getdates();
      });

      var unavailableDates;

      function getdates() {
        $.ajax({
          type: "POST",
          url: "index",
          data: '',
          success: function(data) {
            debugger;
            unavailableDates = data;

            $("#datepicker").datepicker({
              dateFormat: '',
              beforeShowDay: function(date) {
                var dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
                debugger;
                if ($.inArray(dmy, unavailableDates) == -1) {
                  return [true, ""];
                } else {
                  return [false, "myclass", "Unavailable"];
                }
              }
            });
          },
          dataType: "json",
          traditional: true
        });
      }
    </script>
 <script>

var array = @json($start_date);

$('input').datepicker({
    beforeShowDay: function(date){
        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        return [ array.indexOf(string) == -1 ]
    }
});

</script>

<script>

var array = @json($endDate);

$('input').datepicker({
    beforeShowDay: function(date){
        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        return [ array.indexOf(string) == -1 ]
    }
});

</script>
@endif
 
</body>

</html>