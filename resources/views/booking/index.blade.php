<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.min.css')}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>

  <h2>Booking Date</h2>

  <form action="{{URL::to('/bookingcheck')}}" method="post">
    @csrf
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          Start Date :<input type="text" class="col-sm-3 form-control control-label datepicker" id="first" autocomplete="off" name="start_date">
          @if ($errors->has('start_date'))
          <span class="text-danger">{{ $errors->first('start_date') }}</span>
          @endif
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          End Date : <input type="text" class="col-sm-3 form-control control-label datepicker" id="second" autocomplete="off" name="end_date">
          @if ($errors->has('end_date'))
          <span class="text-danger">{{ $errors->first('end_date') }}</span>
          @endif
          <br>
        </div>
      </div>
      <input type="hidden" name="booking_amount" value="@if(session()->get('booking_amount')){{session('booking_amount')}}@endif" id="booking_amount">
      <br>
      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
          <input type="submit" class="btn btn-primary" name="submit">
        </div>
      </div>
      <br><br><br>
    </div>
    @if(session()->get('success')){{session('success')}}@endif
  </form>

  <!-- Validation -->

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
        $("#booking_amount").val(mytotal);
      } else {
        //console.log("Enter valid date.");
      }

    }
  </script>

  <script type="text/javascript">
    var disableDates = ["9-11-2019", "14-11-2019", "15-11-2019", "27-12-2019"];

    $('.datepicker').datepicker({
      format: 'mm/dd/yyyy',
      beforeShowDay: function(date) {
        dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
        if (disableDates.indexOf(dmy) != -1) {
          return false;
        } else {
          return true;
        }
      }
    });
  </script>
  <!-- DatePicker -->
  <!-- 
  <script>
    $("#first").datetimepicker({
      timepicker: false,
      format: "Y-m-d"
    });

    $("#second").datetimepicker({
      timepicker: false,
      format: "Y-m-d"
    });
  </script> -->
</body>

</html>