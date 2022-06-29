@extends('layouts.cmain')
@section('title')
Customer Profile
@endsection
@section('content')
<h1 align="center">Customer Profile</h1>

<div class="main-section">

    <h3>{{Session::get('cupdateMsg')}}</h3>

    <center>
        <table border="2" style="width: 100%;">
            <tr>

                <td style="width: 30%; padding: 10px; padding-left: 40px;">
                    <img src="#" alt="Customer icon" style="width: 150px;">
                    <br> <br>

                    <form action="#" method="POST" enctype="multipart/form-data">
                        <label for="myfile"><b>Select image:</b></label> <br>
                        <input type="file" name="myfile"> <br> <br>
                        <input type="submit" name="submit">
                    </form>
                </td>
                <td style="width: 70%; padding: 20px;">


                    <form action="#" method="POST">

                        {{@csrf_field()}}<br>
                        
                        <fieldset>
                            <legend>My Profile</legend>

                            <table>

                                <tr>
                                    <td><label for="id"><b>ID:</b></label></td>
                                    <td><input type="text" name="id" value="01"></td>
                                </tr>

                                <tr>
                                    <td><label for="username"><b>Username:</b></label></td>
                                    <td><input type="text" name="username" value="MdRasen">
                                        @error('username')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="name"><b>Name:</b></label></td>
                                    <td><input type="text" name="name" value="MdRasen">
                                        @error('name')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="email"><b>Email:</b></label></td>
                                    <td><input type="email" name="email" value="aamin@aiub.edu">
                                        @error('email')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="phone"><b>Phone:</b></label></td>
                                    <td><input type="text" name="phone" value="1630406235">
                                        @error('phone')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="password"><b>Password:</b></label></td>
                                    <td><input type="password" name="password" value="#itzAla71">
                                        @error('password')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="cpassword"><b>CPassword:</b></label></td>
                                    <td><input type="password" name="cpassword" value="#itzAla71">
                                        @error('cpassword')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="gender"><b>Gender:</b></label></td>
                                    <td><input type="text" name="gender" value="Male">
                                        @error('gender')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="dob"><b>DOB:</b></label></td>
                                    <td><input type="date" name="dob" value="25/07/1999">
                                        @error('dob')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="address"><b>Address:</b></label></td>
                                    <td><input type="text" name="address" value="Moghbazar, Dhaka">
                                        @error('address')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="submit" name="update" value="Update">
                                    </td>
                                </tr>

                            </table>

                        </fieldset>
                    </form>

                </td>
            </tr>
        </table>
    </center>

</div>
@endsection
