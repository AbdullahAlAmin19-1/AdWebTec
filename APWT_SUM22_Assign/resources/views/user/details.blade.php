@extends('layouts.userlogged')
@section('content')
<br>
<table border="1">
    <tr><th>Id</th><td>{{$emp->id}}</td> </tr>
    <tr><th>Name</th><td>{{$emp->name}}</td></tr>
    <tr><th>Email</th><td>{{$emp->email}}</td></tr> 
</table>
@endsection
