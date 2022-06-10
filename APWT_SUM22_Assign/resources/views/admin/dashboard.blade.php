@extends('layouts.adminlogged')
@section('content')
<br>
<table border="1">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Type</th>
    </tr>
    @foreach($employes as $emp)
        <tr>
            <td>{{$emp->id}}</td>
            <td><a href="{{route('admin.details',['id'=>$emp->id])}}">{{$emp->name}}</td>
            <td>{{$emp->type}}</td>
        </tr>
    @endforeach
</table>
@endsection