@extends('layouts.main')
@section('title')
Customer Orders
@endsection
@section('content')
<h1 align="center">Customer Orders</h1>

<?php

$total_price = 0;
$discount_amount = 0;

foreach($orders as $item){
    $total_price = $total_price + ($item->quantity * $item->price);
}
if($coupon!=null){
    $discount_amount=$coupon->amount;
}
$pay_money = $total_price + 60 - $discount_amount;


?>

<div class="main-section">
    <center>

        <h3 style="color: red;">{{Session::get('msg')}}</h3>
        <?php
            if(count($orders) != 0){
        ?>
        <table border="2px" style="width: 90%; border-collapse: collapse;">
            <tr>
                <th colspan="8">-- Current Order List --</th>
            </tr>
            <tr>
                {{-- <th>Order ID</th> --}}
                <th>Product</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price (Tk)</th>
                <th>Total Price (Tk)</th>
                <th>Order Status</th>
                <th>Payment Method</th>
                <th>Payment Status</th>

            </tr>

            @foreach ($orders as $item) 
            <tr>
                {{-- <td style="text-align: center;">{{$item->id}}</td> --}}
                <td style="text-align: center; width: 150px;"><img src="{{asset('storage/product_images')}}/{{$item->thumbnail}}" alt="Product Image" height="50px" width="50px"></td>
                <td style="text-align: center;">{{$item->name}}</td>
                <td style="text-align: center;">{{$item->quantity}}</td>
                <td style="text-align: center;">{{$item->price}}</td>
                <td style="text-align: center;">{{$item->quantity * $item->price}}</td>
                <td style="text-align: center;">{{$item->status}}</td>
                <td style="text-align: center;">{{$item->payment_method}}</td>
                <td style="text-align: center;">{{$item->payment_status}}</td>
            </tr>
            @endforeach

            <tr>
                <th colspan="4">Total Price:</th>
                <th colspan="4"><?php echo $total_price; ?> Taka</td>
            </tr>
            <tr>
                <th colspan="4">Delivery Charge:</th>
                <th colspan="4"> 60 Taka</th>
            </tr>

            <tr>
                <th colspan="4">Coupon Discount:</th>
                <th colspan="4"><?php echo $discount_amount; ?> Taka</th>
            </tr>

            <tr>
                <th colspan="8">Money To Pay: <?php echo $pay_money; ?> Taka</th>
            </tr>
        </table>

        <br>

        <table border="2px" style="width: 90%; border-collapse: collapse;">
            <tr>
                <th colspan="8">-- Delivery Details --</th>
            </tr>
            <tr>
                <td colspan="8" style="text-align: center;"><b>Delivery Date:</b> Within 3-5 Days | <b>DeliveryMan:</b> <a href="#"></a></td>
            </tr>
        </table>

        <br> <br>
        <?php
        }
        else
            echo 'You do not have any Pending orders!';
        ?>

        <table border="2px" style="width: 90%; border-collapse: collapse;">
            <tr>
                <th colspan="8">-- Previous Order List --</th>
            </tr>
            <tr>
                {{-- <th>Order ID</th> --}}
                <th>Product</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price (Tk)</th>
                <th>Total Price (Tk)</th>
                <th>Order Status</th>
                {{-- <th>Payment Method</th>
                <th>Payment Status</th> --}}

            </tr>

            @foreach ($dorders as $item) 
            <tr>
                {{-- <td style="text-align: center;">{{$item->id}}</td> --}}
                <td style="text-align: center; width: 150px;"><img src="{{asset('storage/product_images')}}/{{$item->thumbnail}}" alt="Product Image" height="50px" width="50px"></td>
                <td style="text-align: center;">{{$item->name}}</td>
                <td style="text-align: center;">{{$item->quantity}}</td>
                <td style="text-align: center;">{{$item->price}}</td>
                <td style="text-align: center;">{{$item->quantity * $item->price}}</td>
                <td style="text-align: center;">{{$item->status}}</td>
                {{-- <td style="text-align: center;">{{$item->payment_method}}</td>
                <td style="text-align: center;">{{$item->payment_status}}</td> --}}
            </tr>
            @endforeach

        </table>

    </center>

</div>
@endsection
