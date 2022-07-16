@extends('layouts.main')
@section('title')
    Orders
@endsection
@section('content')
<br><br>
<form align="center" action="{{route('vendor.searchorder')}}" method="POST">
        {{@csrf_field()}}
            <input type="search" name="id" id="id" placeholder="Search using Customer Id">
                @error('id')
                    {{$message}}
                @enderror
            <input type="submit" name="search" value="Search">
    </form>
    <h1 align="center">All Order</h1>
        <center>
        <h3 style="color: red;">{{Session::get('msg')}}</h3>
            @foreach ($customers as $customer)
            <?php 
            $total_price=0; 
            $discount_amount=0; 
            $delevery_status=0;
            $pay_money=0;
            $coupon=0;
            ?>  
                <table border="1" style="width: 100%;">
                {{@csrf_field()}}
                    <tr align="center">
                        <th colspan='2'>Customer Name: </th>
                        <td colspan='5'>{{$customer->name}}</td>
                        <th>Customer ID: </th>
                        <td>{{$customer->id}}</td>
                    <tr align="center">
                        <th colspan='2'>Phone Number: </th>
                        <td>+880{{$customer->phone}}</td>
                    <tr align="center">
                        <th colspan='2'>Customer Address: </th>
                        <td colspan='8'>{{$customer->address}}</td>
                    </tr>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Total Quantity</th>
                        <th>Price</th>
                        <th>Purchase Quantity</th>
                        <th>Purchase Price</th>
                        <th>Order Status</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                    </tr>
                    <?php
                    
                    foreach ($customer->products as $p){
                    foreach ($p->orders as $o){
                    ?>   
                    <tr align="center">
                        <td>{{$o->product->id}}</td>
                        <td>{{$o->product->name}}</td>
                        <td>{{$o->product->stock}}</td>
                        <td>{{$o->product->price}}</td>
                        <td>{{$o->quantity}}</td>
                        <td>{{$o->product->price*$o->quantity}}</td>
                        <?php
                            if($o->coupon==NUll){}
                            else{
                                $coupon=$o->coupon->amount;
                            }
                            
                        ?>
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
                    <?php
                        if($o->status!='Delivered'){$delevery_status=1;}
                        $total_price = $total_price + ($o->quantity * $p->price);
                        if($o->coupon!=null){$discount_amount=$coupon;}                        
                        $pay_money = $total_price + 60 - $discount_amount;
                    }
                    break;
                    }
                    ?>  
                     <tr>
                <th colspan="4">Total Price:</th>
                <th colspan="5">{{$total_price}} Taka</td>
            </tr>
            <tr>
                <th colspan="4">Delivery Charge:</th>
                <th colspan="5"> 60 Taka</th>
            </tr>

            <tr>
                <th colspan="4">Coupon Discount:</th>
                <th colspan="5">{{$discount_amount}} Taka</th>
            </tr>

            <tr>
                <th colspan="4">Delevery: 
                    @if($delevery_status==0)
                        Completed
                    @else
                        Pending
                    @endif
                </th>
                <th colspan="5">Total Payment: {{$pay_money}} Taka</th>
            </tr>
                </table><br><br>
            @endforeach
    </center>
@endsection