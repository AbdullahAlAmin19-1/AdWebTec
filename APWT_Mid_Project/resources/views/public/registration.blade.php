@extends('layouts.main')
@section('title')
Registration
@endsection
@section('content')
<form method="post" action="" align="center">
    <fieldset>
        <legend>Registration</legend>
        <h1>{{Session::get('msg')}}</h1>
        {{@csrf_field()}}
        Register as:<input type="radio" id="vendor" name="user_type" value="Vendor"><label for="vendor">Vendor</label>
        <input type="radio" id="customer" name="user_type" value="Customer"><label for="customer">Customer</label>
        <input type="radio" id="deliveryman" name="user_type" value="Deliveryman"><label
            for="deliveryman">Deliveryman</label> @error('user_type'){{$message}}@enderror<br><br>
        Name: <input type="text" name="name" placeholder="Write Your Name" value="{{old('name')}}">
        @error('name'){{$message}}@enderror<br><br>
        User Name: <input type="text" name="uname" placeholder="Write Your User Name" value="{{old('uname')}}">
        @error('uname'){{$message}}@enderror<br><br>
        Email: <input type="text" name="email" placeholder="Write Your Email" value="{{old('email')}}">
        @error('email'){{$message}}@enderror<br><br>
        Phone Number: <input type="text" name="phone" placeholder="Write Your Phone Number" value="{{old('phone')}}">
        @error('phone'){{$message}}@enderror<br><br>
        Password: <input type="password" name="password"
            placeholder="Write Your Password">@error('password'){{$message}}@enderror<br><br>
        Confirm Password: <input type="password" name="conf_password"
            placeholder="Re-Write Your Password">@error('conf_password'){{$message}}@enderror<br><br>
        Gender: <input type="radio" id="male" name="gender" value="Male"><label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="Female"><label for="female">Female</label>
        <input type="radio" id="others" name="gender" value="Others"><label for="others">Others</label>
        @error('gender'){{$message}}@enderror<br><br>
        Date of Birth: <input type="date" id="dob" name="dob" value="{{old('dob')}}">
        @error('dob'){{$message}}@enderror<br><br>
        Address: <input type="text" name="address" placeholder="Write Your Address" value="{{old('address')}}">
        @error('address'){{$message}}@enderror<br><br>
        <input type="submit" value="Registration">
    </fieldset>
</form>
@endsection
