<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/form.css')}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/jquery.datetimepicker.full.js') }}"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
  <div class="container solid">
    <h2 class="dashed" align="center">Booking Date</h2>
    <br>
    @if(!isset($a))
    <form action="{{URL::to('/bookingcheck')}}" method="post">
      @csrf
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            Start Date :<input type="text" class="col-sm-6 form-control control-label datepicker" id="first" autocomplete="off" name="start_date">
            @if ($errors->has('start_date'))
            <span class="text-danger">{{ $errors->first('start_date') }}</span>
            @endif
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            End Date : <input type="text" class="col-sm-6 form-control control-label datepicker" id="second" autocomplete="off" name="end_date">
            @if ($errors->has('end_date'))
            <span class="text-danger">{{ $errors->first('end_date') }}</span>
            @endif
            <br>
          </div>
        </div>
        <input type="hidden" name="total" value="@if(session()->get('total')){{session('total')}}@endif" id="total">
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
    @endif

    <div class="fetchproductData">
      @include('booking/create')
    </div>

    @if (isset($a))
    <div class="container solid" id="form">

      <form class="well form-horizontal" action="{{route('booking.store')}}" method="post" id="contact_form">

        <!-- <form action="{{route('booking.store')}}" method="post"> -->
        <fieldset>

          <!-- Form Name -->
          <div>
            <legend class="dashed" align="center">Booking Form Today!</legend>
          </div>
          <br>
          @csrf

          <div class="input-container">
            <input type="text" name="booking_name" class="formStyle" placeholder="Name" autocomplete="off" /><br>
            @if ($errors->has('booking_name'))
            <span class="text-danger">{{ $errors->first('booking_name') }}</span>
            @endif
          </div>


          <!-- <input type="email" name="booking_email" class="formStyle" placeholder="Email" autocomplete="off"/>
    <input type="email" name="email" class="formStyle" placeholder="Email (required)" required /> -->


          <div class="input-container">

            <input type="email" name="booking_email" class="formStyle" placeholder="Email" autocomplete="off" /><br>
            @if ($errors->has('booking_email'))
            <span class="text-danger">{{ $errors->first('booking_email') }}</span>
            @endif
          </div>

          <div class="input-container">

            <input type="text" class="formStyle" id="first" autocomplete="off" value="@if(session()->get('start_date')){{session('start_date')}}@endif" readonly autocomplete="off" name="start_date">
            @if ($errors->has('start_date'))
            <span class="text-danger">{{ $errors->first('start_date') }}</span>
            @endif
          </div>

          <div class="input-container">

            <input type="text" id="second" class="formStyle" autocomplete="off" value="@if(session()->get('end_date')){{session('end_date')}}@endif" name="end_date" readonly required>
            @if ($errors->has('end_date'))
            <span class="text-danger">{{ $errors->first('end_date') }}</span>
            @endif
          </div>

          <div class="input-container">

            <input type="text" class="formStyle " autocomplete="off" id="total" value="@if(session()->get('total')){{session('total')}}@endif" name="total" readonly>
            @if ($errors->has('total'))
            <span class="text-danger">{{ $errors->first('total') }}</span>
            @endif
          </div>
          <br>
          <div class="input-container">
            <button type="submit" class="formStyle btn btn-warning" name="submit">Send<span class="glyphicon glyphicon-send"></span></button>
          </div>
      </form>
    </div>
    <br><br>
    @if(session()->get('success')){{session('success')}}@endif

    @endif
    <!-- Validation -->

    <script type="text/javascript">
      $(document).ready(function() {
        $("#second").change(function() {
          dayDiff($('#first').val(), $('#second').val());
        });
      });



      $('#first').datepicker({ dateFormat: 'yy-mm-dd' }).val();
      $('#second').datepicker({ dateFormat: 'yy-mm-dd' }).val();
  


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
                var dmy = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
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

    <!-- DatePicker -->
    @if (isset($start_date) && isset($endDate))
    <script>
      var array = @json($start_date);
      // console.log("hii");
      $('input').datepicker({
        beforeShowDay: function(date) {
          var string =formatDate('yy-mm-dd', date);
          return [array.indexOf(string) == -1]
        }
      });

      var array1 = @json($endDate);

      $('input').datepicker({
        beforeShowDay: function(date) {
          var string1 = formatDate('yy-mm-dd', date);
          return [array1.indexOf(string1) == -1]
        }
      });
    </script>
    @endif
    <script>
      function productData() {
        var select_ProductID = document.getElementById('product_id').value;
        alert(select_ProductID);
        if (select_ProductID == "-1") {
          $("#addProduct").hide();
        } else if (select_ProductID == "-2") {
          $("#editProduct").hide();
          $("#addProduct").show();
        } else {
          $("#editProduct").show();
          $("#addProduct").hide();
          $.ajax({
            url: "{{ url('product') }}" + '/' + select_ProductID + '/edit',
            method: "GET",
            data: {
              product_id: select_ProductID,
              _token: "{{ csrf_token() }}"
            },
            success: function(data) {
              $(".fetchproduct_Edit_Data").html(data);
            }
          });
        }
      }

      function fetchData() {
        //timeout
        $(document).ready(function() {
          setTimeout(function() {
            $(".flash-message").remove();
          }, 5000);
        });
        var select = document.getElementById('category').value;
        if (select == -1) {
          document.getElementById("btnSubmit").disabled = true;
        } else {
          $.ajax({
            url: "{{ url('product/fetchData') }}",
            method: "POST",
            data: {
              category_id: select,
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