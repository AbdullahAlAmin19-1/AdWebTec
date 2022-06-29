@extends('layouts.main')
@section('title')
    Enter OTP
@endsection
@section('content')
<form method="post" action="" align="center">
<fieldset>
    <legend>Enter OTP</legend>
    {{@csrf_field()}}<br>
    User Type: <input type="text" name="user_type" value="{{session()->get('user_type')}}" disabled><br><br>
    Email: <input type="text" name="email" value="{{session()->get('email')}}" disabled> <br><br>
    OTP: <input type="text" name="otp" value="Enter OTP"> <br><br>
    <input type="submit" value="Submit">
</fieldset>
</form> 
@endsection