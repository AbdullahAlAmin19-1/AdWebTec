@extends('layouts.main')
@section('title')
Customer Orders
@endsection
@section('content')
<h1 align="center">Customer Orders</h1>

<h3 style="color: red;">{{Session::get('cartRemove')}}</h3>

<div class="main-section">
    <center>
        <table border="2px" style="width: 80%; border-collapse: collapse;">
            <tr>
                <th colspan="7">-- Customer Order List --</th>
            </tr>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Status</th>
                <th>Payment Method</th>
                <th>Payment Status</th>

            </tr>

            @foreach ($orders as $item) 
            <tr>
                <td style="text-align: center;">{{$item->id}}</td>
                <td style="text-align: center;">{{$item->name}}</td>
                <td style="text-align: center;">{{$item->status}}</td>
                <td style="text-align: center;">{{$item->payment_method}}</td>
                <td style="text-align: center;">{{$item->payment_status}}</td>
            </tr>
            @endforeach

            <tr>
                <th colspan="6">Delivery Details</th>
            </tr>
            <tr>
                <td colspan="6" style="text-align: center;"><b>Delivery Date:</b> Within 2-5 Days | <b>DeliveryMan:</b> {{$item->d_id}}</td>
            </tr>
        </table>
    </center>

</div>
@endsection
