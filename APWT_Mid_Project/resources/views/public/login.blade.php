@extends('layouts.main')
@section('title')
    Login
@endsection
@section('content')
<form method="post" action="" align="center">
<fieldset>
    <legend>Login</legend>
    {{@csrf_field()}}<br>
    User Type:  <input type="radio" id="admin" name="user_type" value="Admin"><label for="admin">Admin</label>
                <input type="radio" id="vendor" name="user_type" value="Vendor"><label for="vendor">Vendor</label>
                 <input type="radio" id="customer" name="user_type" value="Customer"><label for="customer">Customer</label>
                <input type="radio" id="deliveryman" name="user_type" value="Deliveryman"><label for="deliveryman">Deliveryman</label><br><br>
    Email: <input type="text" name="email" placeholder="Write Your Email" value="{{old('email')}}"> @error('email'){{$message}}@enderror<br><br>
    Password: <input type="password" name="password"  placeholder="Write Your Password">@error('password'){{$message}}@enderror<br><br>
    <input type="submit" value="Login">
</fieldset>
</form> 
@endsection