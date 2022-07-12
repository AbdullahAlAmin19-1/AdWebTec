@extends('layouts.main')
@section('title')
    Rewiews
@endsection
@section('content')
<h1 align="center">All Rewiew</h1>
@foreach ($reviews as $r)
<table border="1" style="width: 100%;">
    <tr>
        <td style="width: 30%;">
            <center>
                <img style="width: 40%;" src="{{asset('storage/product_images')}}/{{$r->product->thumbnail}}" alt="Product Thumbnail">
            <center>
        </td>
        <td style="width: 70%; padding: 20px;">
            <table border="1">
                <tr><th>Product Name: </th><td>{{$r->product->name}}</td></tr>
                <tr><th>Delivery Date: </th><td>{{$r->created_at}}</td></tr>
                <tr><th>Product Description: </th><td>{{$r->product->description}}</td></tr>
            </table>
                        
        </td>
    </tr>
    <tr><th>Customer Name: </th><td>{{$r->customer->name}}</td></tr>
    <tr><th>Review: </th><td>{{$r->message}}</td></tr><br>
</table>      
@endforeach
   
@endsection