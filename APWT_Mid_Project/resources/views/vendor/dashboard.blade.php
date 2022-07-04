@extends('layouts.main')
@section('title')
    dashboard
@endsection
@section('content')
    <h1 align="center">My Product</h1> 
    <h1 align="center">{{Session::get('msg')}}</h1>
<div class="container">
    @foreach ($p as $product)
    <table border="2" style="width: 100%;">
    <tr>
        <td>
        <table border="2" style="width: 100%;">
        <tr><th colspan="2">Product Picture</th></tr>
        <tr><td colspan="2"><img src="product images/{{$product->thumbnail}}" alt="Product Image" height="120px" width="120px"></td></tr>
        <tr>
            <td><a href="{{route('vendor.editproduct',['id'=>$product->id])}}"><input type="button" value="Edit Product"></a></td>
            <td><a href="{{route('vendor.deleteproduct',['id'=>$product->id])}}"><input type="button" value="Delete Product"></a></td>
        </tr>
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
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <th>Product Id</th>
            <td>{{ $product->id }}</td>
        </tr>
        <tr>
            <th>Product Category</th>
            <td>{{$product->category}}</td>
        </tr>
        <tr>
            <th>Product Thumbnail</th>
            <td>{{$product->thumbnail}}</td>
        </tr>
        <tr>
            <th>Product Price</th>
            <td>{{$product->price}}</td>
        </tr>
        <tr>
            <th>Product Stock</th>
            <td>{{$product->stock}}</td>
        </tr>
        <tr>
            <th>Product Size</th>
            <td>{{$product->size}}</td>
        </tr>
        <tr>
            <th>Product Description</th>
            <td>{{$product->description}}</td>
        </tr>
    </table>
</td>
</tr>
</table>
    @endforeach
</div>
<div align="center">
{{$p->links()}}
</div>
@endsection