@extends('layouts.cmain')
@section('title')
Customer Order
@endsection
@section('content')
<h1 align="center">Customer Order</h1>

<div class="main-section">
    <center>
        <form action="{{route('customer.corderForm');}}" method="POST">
            {{@csrf_field()}}

            <table style="width: 80%; border: 1px solid black;
            border-collapse: collapse;">
                <tr>
                    <th>Product ID:</th>
                    <th><input type="number" name="p_id" id="p_id" value="1" style="width: 30px;" disabled></th>
                    <th>Product Name:</th>
                    <th><input type="text" name="p_name" value="ACI Pure Salt" disabled></th>
                    <th>Quantity:</th>
                    <th><input type="number" name="p_qunatity" value="2" style="width: 30px;"  disabled></th>
                    <th>Price:</th>
                    <th><input type="number" name="p_price" value="64" style="width: 50px;"  disabled></th>
                </tr>

                <tr>
                    <th colspan="5"></th>
                    <th style="padding-top: 5px;">Coupon:</th>
                    <th colspan="2" style="padding-top: 5px;"><input type="text" placeholder="Enter coupon code"></th>
                </tr>

                <tr>
                    <th colspan="8" style="text-align: end; padding: 8px;"><input type="submit" value="Place Order"></th>
                </tr>
            
            </table>
        </form>
    </center>

</div>
@endsection
