@extends('layouts.main')
@section('title')
Profile
@endsection
@section('content')
<h2 align="center">Deliveryman</h2><center>

<div>
    <form action="{{route('admin.asearchcustomer')}}" method="POST">
        {{@csrf_field()}}
        <input type="search" name="search_name" id="search_name" placeholder="Search here">
            @error('search_name')
            {{$message}}
            @enderror
        <input type="submit" name="search" value="Search">
    </form>
</div>
<div>
    <center>
        <table border="2px" style="width: 80%; ">
            <tr>
                <th colspan="8">-- Deliveryman Details --</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Address</th>
                <th>Action</th>
            </tr>

            @foreach ($user as $u) 
            <tr>
                <td style="text-align: center;">{{$u->id}}</td>
                <td style="text-align: center;">{{$u->name}}</td>
                <td style="text-align: center;">{{$u->email}}</td>
                <td style="text-align: center;">{{$u->phone}}</td>
                <td style="text-align: center;">{{$u->gender}}</td>
                <td style="text-align: center;">{{$u->dob}}</td>
                <td style="text-align: center;">{{$u->address}}</td>
                <td style="text-align: center;"><a href="route('admin.customerremove',['id'=>$u->id])}}">Delete Customer</a></td>
            </tr>
            @endforeach

            <tr>
                <th align="center" colspan="8" style="padding: 5px;">{{$user->links()}}</th>
            </tr>
        </table>
    </center>
</div>

@endsection
