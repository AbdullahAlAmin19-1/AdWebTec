@extends('layouts.main')
@section('title')
    Login
@endsection
@section('content')

<form method="post" action="">

    <center>
        <h3 style="color: red;">{{Session::get('logoutMsg')}}</h3>
        <fieldset>
            <legend>Login</legend>
            <h1>{{Session::get('msg')}}</h1>
            {{@csrf_field()}}
            
            <table>
                <tr>
                    <th><label for="user_type">User_Type:</label></th>
                    <td>
                        <input type="radio" id="admin" name="user_type" value="Admin"><label for="admin">Admin</label>
                        <input type="radio" id="vendor" name="user_type" value="Vendor"><label for="vendor">Vendor</label>
                        <input type="radio" id="customer" name="user_type" value="Customer"><label for="customer">Customer</label>
                        <input type="radio" id="deliveryman" name="user_type" value="Deliveryman"><label for="deliveryman">Deliveryman</label>
                        @error('user_type'){{$message}}@enderror
                    </td>
                </tr>
    
                <tr>
                    <th><label for="email">Email:</label></th>
                    <td>
                        <input type="text" name="email" placeholder="Write Your Email" value="{{old('email')}}">
                        @error('email'){{$message}}@enderror
                    </td>
                </tr>
    
                <tr>
                    <th><label for="email">Password:</label></th>
                    <td>
                        <input type="password" name="password" placeholder="Write Your Password" value="{{old('password')}}">
                        @error('password'){{$message}}@enderror
                    </td>
                </tr>
    
                <tr>
                    <th colspan="2">
                    <a href="{{route('public.forgotpassword')}}">Forgot Password?</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Login">&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{route('public.emaillogin')}}"><input type="button" value="Login using Email"></a>
                    </th>
                </tr>
            </table>
    
        </fieldset>
    </center>
</form> 
@endsection