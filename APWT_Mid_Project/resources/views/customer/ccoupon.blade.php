@extends('layouts.main')
@section('title')
Customer Coupons
@endsection
@section('content')
<h1 align="center">Customer Coupons</h1>


<div class="main-section">
    <center>
        <table border="2px" style="width: 90%; border-collapse: collapse;">
            <tr>
                <th colspan="8">-- Customer Coupon List --</th>
            </tr>
            <tr>
                <th>Coupon ID</th>
                <th>Coupon Code</th>
                <th>Discount Amount (Tk)</th>

            </tr>

            {{-- @foreach ($orders as $item) 
            <tr>
                <td style="text-align: center;">{{$item->id}}</td>
                <td style="text-align: center;">{{$item->name}}</td>
                <td style="text-align: center;">{{$item->quantity}}</td>

            </tr>
            @endforeach --}}

        </table>
    </center>

</div>
@endsection
