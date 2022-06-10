@extends('layouts.userlogged')
@section('content')
<br>
<table border="1">
    <tr>
        <th>Id</th>
        <th>Name</th>
    </tr>
    @foreach($employes as $emp)
        <tr>
            <td>{{$emp->id}}</td>
            <td><a href="{{route('user.details',['id'=>$emp->id])}}">{{$emp->name}}</td>
        </tr>
    @endforeach
</table>
@endsection