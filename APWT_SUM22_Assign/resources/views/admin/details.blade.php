@extends('layouts.adminlogged')
@section('content')
<br>
<table border="1">
    <tr><th>Id</th><td>{{$emp->id}}</td> </tr>
    <tr><th>Name</th><td>{{$emp->name}}</td></tr>
    <tr><th>Email</th><td>{{$emp->email}}</td></tr>   
    <tr><th>Type</th><td>{{$emp->type}}</td></tr>   
    <tr><th>Update</th><td>{{$emp->updated_at}}</td></tr>   
    <tr><th>Create</th><td>{{$emp->created_at}}</td></tr>
</table>
@endsection
