@extends('layouts.cmain')
@section('title')
Customer Cart
@endsection
@section('content')
<h1 align="center">Customer Cart</h1>

<h3>{{Session::get('cartRemove')}}</h3>

<div class="main-section">
    <center>
        <table border="2px" style="width: 80%; border-collapse: collapse;">
            <tr>
                <th colspan="5">-- Products In Cart --</th>
            </tr>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Category</th>
                <th>Price</th>
                <th>Action</th>
            </tr>

            @foreach ($products as $item) 
            <tr>
                <td style="text-align: center;">{{$item->p_id}}</td>
                <td style="text-align: center;">{{$item->p_name}}</td>
                <td style="text-align: center;">{{$item->p_category}}</td>
                <td style="text-align: center;">{{$item->p_price}}</td>
                <td style="text-align: center;"><a href="{{route('customer.cartproductremove',['p_id'=>$item->p_id])}}">Remove Product</a></td>
            </tr>
            @endforeach

            <tr>
                <th colspan="5" style="padding: 5px;"><a href="{{route('customer.cdashboard')}}">Browse More</a> | <a href="{{route('customer.corder')}}">Continue To Order</a></th>
            </tr>
        </table>
    </center>

</div>
@endsection
