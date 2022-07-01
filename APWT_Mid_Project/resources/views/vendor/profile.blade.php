@extends('layouts.main')
@section('title')
Account
@endsection
@section('content')
<h1 align="center">Account</h1>

<div class="main-section">

    <h3>{{Session::get('cupdateMsg')}}</h3>

    <center>
        <table border="2" style="width: 100%;">
            <tr>
                <td style="width: 30%; padding: 10px;">
                <center>
                    <img src="{{asset('storage/vendor_profile_images')}}/{{$vendor->propic}}" alt="Customer icon" style="width: 300px;">
                    <br> <br>
                <center>
                </td>
                <td style="width: 70%; padding: 20px;">
                        {{@csrf_field()}}
                        <fieldset>
                            <legend>My Profile</legend>
                            <table>
                                <tr>
                                    <td><label for="id"><b>ID:</b></label></td>
                                    <td><input type="text" name="id" value="{{$vendor->id}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><label for="username"><b>User Name:</b></label></td>
                                    <td><input type="text" name="username" value="{{$vendor->username}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><label for="name"><b>Name:</b></label></td>
                                    <td><input type="text" name="name" value="{{$vendor->name}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><label for="email"><b>Email:</b></label></td>
                                    <td><input type="email" name="email" value="{{$vendor->email}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><label for="phone"><b>Phone:</b></label></td>
                                    <td><input type="text" name="phone" value="{{$vendor->phone}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><label for="password"><b>Password:</b></label></td>
                                    <td><input type="password" name="password" value="{{$vendor->password}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><label for="gender"><b>Gender:</b></label></td>
                                    <td><input type="text" name="gender" value="{{$vendor->gender}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><label for="dob"><b>DOB:</b></label></td>
                                    <td><input type="date" name="dob" value="{{$vendor->dob}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><label for="address"><b>Address:</b></label></td>
                                    <td><input type="text" name="address" value="{{$vendor->address}}" disabled></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="{{route('vendor.editprofile');}}" style="font-size: 20px;"> <input type="button" value="Edit Profile"></a>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                </td>
            </tr>
        </table>
    </center>
</div>
@endsection
