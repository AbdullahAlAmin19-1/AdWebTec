@extends('layouts.main')
@section('title')
    Orders
@endsection
@section('content')
    <h1 align="center">All Order</h1>
        <center>
            <h1>{{Session::get('msg')}}</h1>
                <table border="2" style="width: 100%;">
                {{@csrf_field()}}
                    <tr>
                        <th>Order Id</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Customer Name</th>
                        <th>Order Status</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                        <th>Delivery Address</th>
                    </tr>
                    @foreach ($orders as $o)
                    <tr align="center">
                        <td>{{$o->id}}</td>
                        <td>{{$o->products->name}}</td>
                        <td>{{$o->quantity}}</td>
                        <td>{{$o->customer->name}}</td>
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
                        <td>{{$o->delivery_address}}</td>
                        </tr>
                    @endforeach
                </table>
    </center>
@endsection