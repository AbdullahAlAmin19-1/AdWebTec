@extends('layouts.main')
@section('title')
    Orders
@endsection
@section('content')
    <h1 align="center">All Order</h1>
        <center>
        <h3 style="color: red;">{{Session::get('msg')}}</h3>
                <table border="1" style="width: 100%;">
                {{@csrf_field()}}
                @foreach ($orders as $o)
                    <tr>
                        <th>Customer Name: </th>
                        <td colspan='5'>{{$o->customer->name}}</td>
                        <th>Order Date: </th>
                        <td>{{$o->created_at}}</td>
                    <tr>
                        <th>Phone Number: </th>
                        <td>+880{{$o->customer->phone}}</td>
                    <tr>
                        <th>Delivery Address: </th>
                        <td colspan='5'>{{$o->delivery_address}}</td>
                    </tr>
                        <th>Product Name</th>
                        <th>Total Quantity</th>
                        <th>Price</th>
                        <th>Purchase Quantity</th>
                        <th>Purchase Price</th>
                        <th>Order Status</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                    </tr>
                    <tr align="center">
                        <td>{{$o->products->name}}</td>
                        <td>{{$o->products->stock}}</td>
                        <td>{{$o->products->price}} Taka</td>
                        <td>{{$o->quantity}}</td>
                        <td>{{$o->products->price*$o->quantity}} Taka</td>
                        <td>{{$o->status}}
                            @if($o->status=='Pending')
                            <a href="{{route('vendor.changeorderstatus',['id'=>$o->id])}}">Change</a> 
                            @elseif($o->status=='Confirmed' && $o->payment_status=='Confirmed')
                            <a href="{{route('vendor.changeorderstatus',['id'=>$o->id])}}">Change</a> 
                            @endif
                        </td>
                        <td>{{$o->payment_method}}</td>
                        <td>{{$o->payment_status}}
                            @if($o->status=='Confirmed' && $o->payment_status!='Confirmed')
                            <a href="{{route('vendor.changepaymentstatus',['id'=>$o->id])}}">Change</a> 
                            @endif
                        </td>
                        </tr>
                    @endforeach
                </table>
    </center>
@endsection