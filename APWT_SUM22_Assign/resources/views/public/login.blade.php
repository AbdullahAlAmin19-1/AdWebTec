@extends('layouts.main')
@section('title')
    Login
@endsection
@section('content')
<form method="post" action="">
    {{@csrf_field()}}<br>
    User Type:  <input type="radio" id="admin" name="user_type" value="Admin"><label for="admin">Admin</label>
                <input type="radio" id="user" name="user_type" value="User"><label for="user">User</label><br><br>
    Email: <input type="text" name="email" placeholder="Write Your Email" value="{{old('email')}}"> @error('email'){{$message}}@enderror<br><br>
    Password: <input type="password" name="password"  placeholder="Write Your Password">@error('password'){{$message}}@enderror<br><br>
    <input type="submit" value="Login">
</form> 
@endsection