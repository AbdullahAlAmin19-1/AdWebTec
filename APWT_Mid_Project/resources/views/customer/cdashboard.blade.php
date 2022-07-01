@extends('layouts.cmain')
@section('title')
    Customer Home
@endsection
@section('content')
    <div class="main-section">
        <h1 style="text-align: center">Customer Dashboard</h1>
        
        <div class="product-section">
            <center>
        
                <table style="width: 70%; border: 1px solid black; border-radius: 10px;">
                    <h3>-- Categories --</h3>
                    <tr>
                        <th><a href="#">Fruits & Vegetables</a><th>
                        <th><a href="#">Meat & Fish</a><th>
                        <th><a href="#">Cooking</a><th>
                        <th><a href="#">Baking</a><th>
                        <th><a href="#">Dairy</a><th>
                    </tr>
        
                    <br>
        
                    <tr>
                        <th><a href="#">Candy & Chocolate</a><th>
                        <th><a href="#">Frozen & Canned</a><th>
                        <th><a href="#">Bread & Bakery</a><th>
                        <th><a href="#">Snacks</a><th>
                        <th><a href="#">Beverages</a><th>
                    </tr>
                </table>
        
                <br>
        
                <table style="width: 90%;">
                        <h3>-- Top Selling Products --</h3>
        
                    <tr>
                        @foreach ($products5 as $item) 
                        <td>
                            <img src="product images/{{$item->p_thumbnail}}" alt="Product Image" height="120px" width="120px">
                            <h3>{{$item->p_name}}</h3>
                            <p>{{$item->p_description}}</p>
                            <h4>Price: {{$item->p_price}} Taka.</h4>
                            <form action="{{route('customer.caddcart');}}" method="POST" enctype="multipart/form-data">
                                {{@csrf_field()}}
                                <label for="quantity" style="width: 50%">Quantity</label>
                                <input type="number" name="quantity" id="Quantity" min="1" value="1" style="width: 50%"> <br>
                                @error('quantity')
                                        {{$message}} <br> <br> 
                                        @enderror
                                <input type="submit" name="caddcart" value="Add To Cart" style="width: 75%">
                            </form>
                        </td>
                        @endforeach
                    </tr>
        
                    <tr>
                        @foreach ($products10 as $item) 
                        <td>
                            <img src="product images/{{$item->p_thumbnail}}" alt="Product Image" height="120px" width="120px">
                            <h3>{{$item->p_name}}</h3>
                            <p>{{$item->p_description}}</p>
                            <h4>Price: {{$item->p_price}} Taka.</h4>
                            <form action="{{route('customer.caddcart');}}" method="POST" enctype="multipart/form-data">
                                {{@csrf_field()}}
                                <label for="quantity" style="width: 50%">Quantity</label>
                                <input type="number" name="quantity" id="Quantity" min="1" value="1" style="width: 50%"> <br>
                                @error('quantity')
                                        {{$message}} <br> <br> 
                                        @enderror
                                <input type="submit" name="caddcart" value="Add To Cart" style="width: 75%">
                            </form>
                        </td>
                        @endforeach
                    </tr>
                    
                    <tr>
                        <td colspan="5" style="text-align: right;"><a href="{{route('public.allproducts')}}">SEE ALL PRODUCTS</a></td>
                    </tr>
        
                </table>
        
            </center>
        </div>
        
    </div>
@endsection