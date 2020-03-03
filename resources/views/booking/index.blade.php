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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" />

  <!-- BOOTSTRAP SCRIPT CDN -->

  <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <!-- DATEPICKER SCRIPT CDN -->

  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/jquery.datetimepicker.full.js') }}"></script>
</head>

<body>
  <div class="container solid">
    <h2 class="dashed" align="center">Booking Date</h2>
    <br>
    <form action="{{URL::to('/bookingcheck')}}" method="post" id="form">
      @csrf
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            Start Date :<input type="text" class="col-sm-3 form-control control-label datepicker" id="first" autocomplete="off" name="start_date">
            @if ($errors->has('start_date'))
            <span class="text-danger">{{ $errors->first('start_date') }}</span>
            @endif
            <br>
            End Date : <input type="text" class="col-sm-3 form-control control-label datepicker" id="second" autocomplete="off" name="end_date">
            @if ($errors->has('end_date'))
            <span class="text-danger">{{ $errors->first('end_date') }}</span>
            @endif
          </div>
        </div>
        <!-- <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            End Date : <input type="text" class="col-sm-3 form-control control-label datepicker" id="second" autocomplete="off" name="end_date">
            @if ($errors->has('end_date'))
            <span class="text-danger">{{ $errors->first('end_date') }}</span>
            @endif
            <br>
          </div> -->
      </div>
      <input type="hidden" name="total" value="@if(session()->get('total')){{session('total')}}@endif" id="total">
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

  <script>
    $('#first').datepicker({
      format: "Y-m-d",
      maxDate: function() {
        return $('#second').val();
      }
    });
    $('#second').datepicker({
      format: "Y-m-d",
      minDate: function() {
        return $('#first').val();
      },
      change: function(e) {
        //get date in yyyy/mm/dd format
        var vl = $(this).val().split('/').reverse().join('/');
        //getTime to compare with current timestamp
        var ds = new Date(vl).getTime();
        //current timestamp
        var dn = e.timeStamp;
        $('#submit').prop('disabled', ds < dn);
      }
    });
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

 <script>
$(document).ready(function(){
  var select = document.getElementById('id').value;
  if(select == -1){
    $("#date").show(); 
  }
  if(select == -2){
    $("#date").hide(); 
  }
});
function hideshow(){
  var select = document.getElementById('id').value;
  if(select == -2){
    $("#date").show(); 
    
  }
  if(select != -2){
    $("#date").hide(); 
  }
}
</script>
<script>
    $(document).ready(function(){
        var select_ProductID = document.getElementById('id').value;
        
        if(select_ProductID == -2){
        $("#date").show(); 
        }
        if(select_ProductID == -1){
        $("#date").hide(); 
        }
        else{
            $("#date").hide();
        }

});
</script>
  </script>
</body>

</html>