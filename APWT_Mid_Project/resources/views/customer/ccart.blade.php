@extends('layouts.cmain')
@section('title')
Customer Cart
@endsection
@section('content')
<h1 align="center">Customer Cart</h1>

<div class="main-section">
    <center>
        <table border="2px" style="width: 80%; border-collapse: collapse;">
            <tr>
                <th colspan="4">-- Products In Cart --</th>
            </tr>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            <tr>
                <td style="text-align: center;">01</td>
                <td style="text-align: center;">ACI Pure Salt</td>
                <td style="text-align: center;">2</td>
                <td style="text-align: center;">64</td>
            </tr>
            <tr>
                <td style="text-align: center;">03</td>
                <td style="text-align: center;">ACI Pure Sugar</td>
                <td style="text-align: center;">3</td>
                <td style="text-align: center;">184</td>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>Total Price:</th>
                <th>248</th>
            </tr>
            <tr>
                <th colspan="4" style="padding: 5px;"><a href="{{route('customer.cdashboard')}}">Browse More</a> | <a href="{{route('customer.corder')}}">Continue To Order</a></th>
            </tr>
        </table>
    </center>

</div>
@endsection
