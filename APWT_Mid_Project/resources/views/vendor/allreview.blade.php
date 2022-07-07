@extends('layouts.main')
@section('title')
    Rewiews
@endsection
@section('content')
    <h1 align="center">All Rewiew</h1>
        <center>
            <h1>{{Session::get('msg')}}</h1>
                <table border="2" style="width: 100%;">
                {{@csrf_field()}}
                    <tr>
                        <th>Review Id</th>
                        <th>Message</th>
                        <th>Customer Id</th>
                        <th>Product Id</th>
                    </tr>
                    @foreach ($reviews as $r)
                    <tr align="center">
                        <td>{{$r->id}}</td>
                        <td>{{$r->message}}</td>
                        <td>{{$r->c_id}}</td>
                        <td>{{$r->p_id}}</td>
                        </tr>
                    @endforeach
                </table>
    </center>
@endsection