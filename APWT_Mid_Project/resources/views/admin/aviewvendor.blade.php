@extends('layouts.main')
@section('title')
    dashboard
@endsection
@section('content')
    <h1 align="center">Vendor</h1> 
    <h1 align="center">{{Session::get('msg')}}</h1>
<div class="container">
    @foreach ($user as $u)
    <center>
    <table border="2" style="width: 60%;">
    <tr>
        <td>
        <center>
        <table border="2" style="width: 90%;">
        <tr><th colspan="2">Vendor Picture</th></tr>
        <tr><td align="center" colspan="2"><img src="vendor_images/{{$u->propic}}" alt="Vendor Image" height="120px" width="120px"></td></tr>
        <tr>
            
        </tr>
        </table>
        </center>
        </td>
        <td>
        <table border="2" style="width: 100%;">
        <tr>
            <th >Vendor Id</th>
            <td>{{$u->id}}</td>
        </tr>
        <tr>
            <th>Vendor Name</th>
            <td>{{ $u->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $u->email}}</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>{{$u->phone}}</td>
        </tr>
        <tr>
            <th>Gender</th>
            <td>{{$u->gender}}</td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td>{{$u->dob}}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{$u->address}}</td>
        </tr>
    </table>
</td>
</tr>
</table>
</center>
    @endforeach
</div>

@endsection