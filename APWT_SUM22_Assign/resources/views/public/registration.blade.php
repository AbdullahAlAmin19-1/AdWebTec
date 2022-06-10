@extends('layouts.main')
@section('title')
    Registration
@endsection
@section('content')
<form method="post" action="">
    {{@csrf_field()}}<br>
    Name: <input type="text" name="name" placeholder="Write Your Name" value="{{old('name')}}"> @error('name'){{$message}}@enderror<br><br>
    Email: <input type="text" name="email" placeholder="Write Your Email" value="{{old('email')}}"> @error('email'){{$message}}@enderror<br><br>
    Password: <input type="password" name="password"  placeholder="Write Your Password">@error('password'){{$message}}@enderror<br><br>
    Confirm Password: <input type="password" name="conf_password"  placeholder="Re-Write Your Password">@error('conf_password'){{$message}}@enderror<br><br>
    <input type="submit" value="Registration">
</form> 
@endsection