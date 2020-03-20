
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
@csrf
<div class="container solid"  id="create" align="center">

    <form class="well form-horizontal" action="/booking-create" method="POST" id="contact_form">
    
      <fieldset>

        <!-- Form Name -->
        <div>
          <legend class="dashed">Booking Form Today!</legend>
        </div>
        <br>
        @csrf

        <div class="input-container">
          <i class="fa fa-user icon">:Name</i>
          <input type="text" class="col-sm-6 input-field form-control control-label" placeholder="Name" autocomplete="off" name="booking_name">
          @if ($errors->has('booking_name'))
          <span class="text-danger">{{ $errors->first('booking_name') }}</span>
          @endif
        </div>

        <div class="input-container">
          <i class="fa fa-envelope icon">:Email</i>
          <input type="email" class="col-sm-6 input-field form-control control-label" autocomplete="off" name="booking_email" placeholder="Email">
          @if ($errors->has('booking_email'))
          <span class="text-danger">{{ $errors->first('booking_email') }}</span>
          @endif
        </div>

        <div class="input-container">
          <i class="fa fa-calendar icon" aria-hidden="true">:Start Date</i>
          <input type="text" class="col-sm-6 input-field form-control control-label" id="first_st" autocomplete="off" value="@if(session()->get('start_date')){{session('start_date')}}@endif" readonly autocomplete="off" name="start_date">
          @if ($errors->has('start_date'))
          <span class="text-danger">{{ $errors->first('start_date') }}</span>
          @endif
        </div>

        <div class="input-container">
          <i class="fa fa-calendar icon">:End Date</i>
          <input type="text" id="second_st" class="col-sm-6 input-field form-control control-label" autocomplete="off" value="@if(session()->get('end_date')){{session('end_date')}}@endif" name="end_date" readonly required>
          @if ($errors->has('end_date'))
          <span class="text-danger">{{ $errors->first('end_date') }}</span>
          @endif
        </div>

        <div class="input-container">
          <i class="fa fa-inr icon" aria-hidden="true">:Amount(Fix amount was with 500(if your total bill was >10000 the tax will be apply as a 10% or else tax will be apply as a 5%))</i>
          <input type="text" class="col-sm-6 form-control input-field control-label " autocomplete="off" id="total" value="@if(session()->get('total')){{session('total')}}@endif" name="total" readonly>
          @if ($errors->has('total'))
          <span class="text-danger">{{ $errors->first('total') }}</span>
          @endif
        </div>
        <br>
        <div class="input-container">
          <button type="submit" class="col-sm-6 form-control input-field control-label btn btn-warning" name="submit">Send<span class="glyphicon glyphicon-send"></span></button>
        </div>
    </form>
  </div>
  