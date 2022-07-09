@extends('layouts.main')
@section('title')
    Rewiews
@endsection
@section('content')
    <h1 align="center">All Rewiew</h1>
        <center>
                <table border="2" style="width: 100%;">
                {{@csrf_field()}}
                    <tr>
                        <!-- <th>Review Id</th> -->
                        <th>Customer Name</th>
                        <th>Product Name</th>
                        <th>Rewiew</th>
                    </tr>
                    @foreach ($reviews as $r)
                    <tr align="center">
                        <!-- <td>{{$r->id}}</td> -->
                        <td>{{$r->customer->name}}</td>
                        <td>{{$r->product->name}}</td>
                        <td>{{$r->message}}</td>
                        </tr>
                    @endforeach
                </table>
    </center>
@endsection