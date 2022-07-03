@extends('layouts.main')
@section('title')
    Delete Product
@endsection
@section('content')
    <h1 align="center">Delete Product</h1>
<div class="container">
    <table border="2" style="width: 100%;">
    <tr>
        <td>
        <table border="2" style="width: 100%;">
        <tr><th>Product Picture</th></tr>
        <tr><td> {{$product->p_gallery}}</td></tr>
        </table>
        </td>
        <td>
        <table border="2" style="width: 100%;">
        <tr>
            <th>Vendor Id</th>
            <td>{{$product->v_id}}</td>
        </tr>
        <tr>
            <th>Product Name</th>
            <td>{{ $product->p_name }}</td>
        </tr>
        <tr>
            <th>Product Id</th>
            <td>{{ $product->p_id }}</td>
        </tr>
        <tr>
            <th>Product Category</th>
            <td>{{$product->p_category}}</td>
        </tr>
        <tr>
            <th>Product Thumbnail</th>
            <td>{{$product->p_thumbnail}}</td>
        </tr>
        <tr>
            <th>Product Price</th>
            <td>{{$product->p_price}}</td>
        </tr>
        <tr>
            <th>Product Stock</th>
            <td>{{$product->p_stock}}</td>
        </tr>
        <tr>
            <th>Product Color</th>
            <td>{{$product->p_color}}</td>
        </tr>
        <tr>
            <th>Product Size</th>
            <td>{{$product->p_size}}</td>
        </tr>
        <tr>
            <th>Product Description</th>
            <td>{{$product->p_description}}</td>
        </tr>
        <tr>
            <th colspan="2"><a href="{{route('vendor.deleteproductConfirm',['p_id'=>$product->p_id])}}"><input type="button" value="Delete"></a></tH>
        </tr>
    </table>
</td>
</tr>
</table>
</div>
@endsection