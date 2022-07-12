@extends('layouts.main')
@section('title')
    Coupons
@endsection
@section('content')
    <h1 align="center">All Coupon</h1>
        <center>
        <h3 style="color: red;">{{Session::get('msg')}}</h3>
                <table border="2" style="width: 50%;">
                {{@csrf_field()}}
                    <tr>
                        <th>Coupon Id</th>
                        <th>Coupon Code</th>
                        <th>Discount Amount</th>
                        <th>Option</th>
                    </tr>
                    @foreach ($coupons as $c)
                    <tr align="center">
                        <td>{{$c->id}}</td>
                        <td>{{$c->code}}</td>
                        <td>{{$c->amount}}</td>
                        <td><a href="{{route('vendor.editcoupon',['id'=>$c->id])}}">Edit</a> <a href="{{route('vendor.deletecoupon',['id'=>$c->id])}}">Delete</a></td>
                        </tr>
                    @endforeach
                </table>
    </center>
@endsection