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
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/jquery.datetimepicker.full.js') }}"></script>
</head>

<body>
  <div class="container solid add_form" id="form">
    <h2 class="dashed" align="center">Booking Date</h2>
    <br>
    <form action="{{URL::to('/bookingcheck')}}" id="addform" method="post" >
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
          <input type="submit" id="submit" class="btn btn-primary" onclick="productData()" name="submit">
        </div>
      </div>
      <br><br><br>
  </div>
  @if(session()->get('success')){{session('success')}}@endif
  </form>

  <div class="fetchproductData">
    @include('booking/create')
</div>
  <input type="hidden" class="col-sm-3 form-control control-label datepicker" id="first" autocomplete="off" name="start_date">
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
  </script>>

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
    var disableDates = ['start_date,end_date'];
      
      $('.datepicker').datepicker({
          format: 'Y-m-d',
          beforeShowDay: function(date){
              dmy = year.getYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
              if(disableDates.indexOf(dmy) != -1){
                  return false;
              }
              else{
                  return true;
              }
          }
      });
  </script>
  <script>
 function productData() {
        var select_ProductID = document.getElementById('submit').value;
        //alert(select_ProductID);
        if (select_ProductID == "-1") {
            $("#contact_form").hide();
        } else {
            $("#form").show();
            $("#contact_form").hide();
            $.ajax({
                url: "{{ url('booking') }}" + '/' + select_ProductID + '/create',
                method: "GET",
                data: {
                    product_id: select_ProductID,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $(".add_form").html(data);
                }
            });
        }
    }
    function fetchData() {
        //timeout
        var select = document.getElementById('addform').value;
        if (select == -1) {
            document.getElementById("submit").disabled = true;
        } else {
            $.ajax({
                url: "{{ url('booking/create') }}",
                method: "POST",
                data: {
                    id: select,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    $(".fetchproductData").html(data);
                }
            });
        }
    }
    fetchData();

  </script>
</body>

</html>