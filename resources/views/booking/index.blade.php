@extends('booking.layout')

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('css/jquery.datetimepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/form.css')}}">
  <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/jquery.datetimepicker.full.js') }}"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>

  <div class="container solid">
    <h2 class="dashed" align="center">
      <font color="blue">Booking Date</font>
    </h2>
    <br>
    <form method="post" id="booking" class="form-inline" action="{{url('bookingcheck')}}">
      @csrf
      <div class="row" align="center" id="date">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="startDate">Start Date:</label>
            <input type="text" class="form-control datepicker required" id="first" autocomplete="off" name="start_date" readonly>
            @if ($errors->has('start_date'))
            <span class="text-danger">{{ $errors->first('start_date') }}</span>
            @endif
          </div>
        </div>
        <br />
        <br />
        <br><br />
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <label for="endDate">End Date:</label>
            <input type="text" class="form-control datepicker required" id="second" autocomplete="off" name="end_date" readonly>
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
            <button type="button" class="btn btn-primary" id="submit" name="submit" onclick="checkBookingAvaibility()">Submit </button>
          </div>
          <span class="text-danger" id="avaibility"></span>
        </div>
        <br><br><br>
      </div>
      @if(session()->get('success')){{session('success')}}@endif
    </form>
    @include('booking.create')
    <script type="text/javascript">
      $(document).ready(function() {
        $("#second").change(function() {
          dayDiff($('#first').val(), $('#second').val());
        });
      });

      var disabledArr = @json($data);
      $('#first').datepicker({
        dateFormat: 'yy-mm-dd',
        beforeShowDay: function(date) {
          //console.log(date);

          // For each calendar date, check if it is within a disabled range.
          for (i = 0; i < disabledArr.length; i++) {
            // Get each from/to ranges
            var From = disabledArr[i].start_date.split("-");
            var To = disabledArr[i].end_date.split("-");
            // Format them as dates : Year, Month (zero-based), Date
            var FromDate = new Date(From[0], From[1] - 1, From[2]);
            var ToDate = new Date(To[0], To[1] - 1, To[2]);

            // Set a flag to be used when found
            var found = false;
            // Compare date
            if (date >= FromDate && date <= ToDate) {
              found = true;
              return [false, "red"]; // Return false (disabled) and the "red" class.
            }
          }

          //At the end of the for loop, if the date wasn't found, return true.
          if (!found) {
            return [true, ""]; // Return true (Not disabled) and no class.
          }
        }
      }).val();
      $('#second').datepicker({
        dateFormat: 'yy-mm-dd',
        beforeShowDay: function(date) {
          //console.log(date);

          // For each calendar date, check if it is within a disabled range.
          for (i = 0; i < disabledArr.length; i++) {
            // Get each from/to ranges
            var From = disabledArr[i].start_date.split("-");
            var To = disabledArr[i].end_date.split("-");
            // Format them as dates : Year, Month (zero-based), Date
            var FromDate = new Date(From[0], From[1] - 1, From[2]);
            var ToDate = new Date(To[0], To[1] - 1, To[2]);

            // Set a flag to be used when found
            var found = false;
            // Compare date
            if (date >= FromDate && date <= ToDate) {
              found = true;
              return [false, "red"]; // Return false (disabled) and the "red" class.
            }
          }
          //At the end of the for loop, if the date wasn't found, return true.
          if (!found) {
            return [true, ""]; // Return true (Not disabled) and no class.
          }
        }
      }).val();



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
          // console.log(dayDiff);
          //alert(dayDiff);

          var total = dayDiff * 500;
          // alert(total);
          if (total > 10000) {
            var lastval = (total * 10) / 100;
            // console.log(lastval);
            // alert(lastval);
          } else {
            var lastval = (total * 5) / 100;
            // console.log(lastval);
            // alert(lastval);
          }
          var mytotal = total + lastval;
          // console.log(mytotal);
          $("#total").val(mytotal);
        } else {
          //console.log("Enter valid date.");
          type = "button"
        }

      }
    </script>
    <script>
      function checkBookingAvaibility() {
        var start_date = $("#first").val();
        var end_date = $("#second").val();
        $.ajax({
          url: "bookingcheck",
          method: "POST",
          data: {
            start_date: start_date,
            end_date: end_date,
            _token: "{{ csrf_token() }}"
          },
          success: function(data) {
            //data = JSON.stringify(data);

            if (data == 1) {
              $('#contact_form').show();
              // $('#contact_form').triger("reset");
              $('#contact_form')[0].reset();
              $('#first_st').val(start_date);
              $('#second_st').val(end_date);
            } else {
              $("#avaibility").html(data.message);
              $('#contact_form').hide();
            }
          },
          error: function(reject) {
            // if( reject.staus === 422) {
              var errors = $.parseJSON(reject.responseText);
              $.each(errors.errors,function(key,val){
                alert(val[0])
                $("#" + "_error").show();
               $("#" + key + "_error").text(val[0]); 
              });
          }
            });
        $.ajax({
          url: "booking-form",
          method: "POST",
          data: {
            start_date: start_date,
            end_date: end_date,
            _token: "{{ csrf_token() }}"
          },
          success: function(data) {
            data = JSON.stringify(data);
            // console.log(data);
            if (data.success && !data.is_available) {
              $("#avaibility").html(data.message);
            }
          },
          error: function(err) {
            console.log(err);
          }
        });
        // console.log(start_date);

        var unavailableDates;

        function getdates() {
          console.log("hii");
          $.ajax({
            type: "get",
            url: "booking-form",
            data: '',
            success: function(data) {
              unavailableDates = data;
              $("#datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                beforeShowDay: function(date) {
                  console.log("hii");
                  var dmy = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
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
          // console.log("hii");
        }


        /*if (submit !== null) {
          $('#contact_form').show();
        } else
          $('#contact_form').hide();

        $('.required').each(function() {
          if ($(this).val() == "") {
            $("#contact_form").hide();
            return false;
          } else {
            $("#contact_form").show();
          }
        });*/
        return true;
      }
    </script>

    <!-- DatePicker -->
    @if (isset($start_date) && isset($endDate))
    <!-- <script>
    var array = @json($start_date);
    // console.log("hii");
    $('input').datepicker({
      beforeShowDay: function(date) {
        var string = formatDate('yy-mm-dd', date);
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
  </script> -->
    @endif
    <script>
      $(document).ready(function() {
        var select_ProductID = document.getElementById('submit').value;
        if (select_ProductID !== null) {
          $("#contact_form").hide();
        } else {
          $("#contact_form").hide();
        }
      });
    </script>

    <script>
      var bindDateRangeValidation = function(f, s, e) {
        if (!(f instanceof jQuery)) {
          console.log("Not passing a jQuery object");
        }

        var jqForm = f,
          startDateId = s,
          endDateId = e;

        var checkDateRange = function(startDate, endDate) {
          var isValid = (start_date != "" && end_date != "") ? start_date <= end_date : true;
          return isValid;
        }

        var hookValidatorEvt = function() {
          var dateBlur = function(e, bundleDateId, action) {
            jqForm.bootstrapValidator('revalidateField', e.target.id);
          }

          $('#' + startDateId).on("dp.change dp.update blur", function(e) {
            $('#' + endDateId).data("DateTimePicker").setMinDate(e.date);
            dateBlur(e, endDateId);
          });

          $('#' + endDateId).on("dp.change dp.update blur", function(e) {
            $('#' + startDateId).data("DateTimePicker").setMaxDate(e.date);
            dateBlur(e, startDateId);
          });
        }

        // bindValidator();
        hookValidatorEvt();
      };
     </script>
</body>

</html>