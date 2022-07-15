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
                    @foreach ($products as $p)
                        <!-- <th>Review Id</th> -->
                        <th>Product Name: {{$p->name}}</th>
                    </tr>
                    @foreach ($p->reviews as $r)
                    <tr align="center">
                        <!-- <td>{{$r->id}}</td> -->
                        <td>{{$r->customer->name}}</td>
                        <td>{{$r->message}}</td>
                        </tr>
                    @endforeach
                    @endforeach
                </table>
    </center>
@endsection