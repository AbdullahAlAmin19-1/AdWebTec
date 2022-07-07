@extends('layouts.main')
@section('title')
    Home
@endsection
@section('content')

    <h1 align="center">Online Groceries Ordering System</h1>

    <div class="product-section">
        <center>
    
            <table style="width: 70%; border: 1px solid black; border-radius: 10px;">
                <h3>-- Categories --</h3>
                <tr>
                    <th><a href="{{route('public.searchcategory', ['category'=>"Fruits & Vegetables"])}}">Fruits & Vegetables</a><th>
                    <th><a href="{{route('public.searchcategory', ['category'=>"Meat & Fish"])}}">Meat & Fish</a><th>
                    <th><a href="{{route('public.searchcategory', ['category'=>"Cooking"])}}">Cooking</a><th>
                    <th><a href="{{route('public.searchcategory', ['category'=>"Baking"])}}">Baking</a><th>
                    <th><a href="{{route('public.searchcategory', ['category'=>"Dairy"])}}">Dairy</a><th>
                </tr>
    
                <br>
    
                <tr>
                    <th><a href="{{route('public.searchcategory', ['category'=>"Candy & Chocolate"])}}">Candy & Chocolate</a><th>
                    <th><a href="{{route('public.searchcategory', ['category'=>"Frozen & Canned"])}}">Frozen & Canned</a><th>
                    <th><a href="{{route('public.searchcategory', ['category'=>"Bread & Bakery"])}}">Bread & Bakery</a><th>
                    <th><a href="{{route('public.searchcategory', ['category'=>"Snacks"])}}">Snacks</a><th>
                    <th><a href="{{route('public.searchcategory', ['category'=>"Beverages"])}}">Beverages</a><th>
                </tr>
            </table>
    
            <br>
    
            <table style="width: 90%;">
                    <h3>-- Selling Products --</h3>
    
                <tr>
                    @foreach ($p as $item) 
                    <th>
                        <center>
                            <img src="{{asset('storage/product_images')}}/{{$item->thumbnail}}" alt="Product Image" height="120px" width="120px">
                        <h3>{{$item->name}}</h3>
                        <textarea style="width: 75%" disabled>{{$item->description}}</textarea>
                        <h4>Price: {{$item->price}} Taka.</h4>
                        <form action="{{route('customer.caddcart')}}" method="POST">
                            {{@csrf_field()}}
                            <input type="hidden" name="p_id" id="p_id" value="{{$item->id}}"> <br>
                            <label for="quantity" style="width: 50%">Quantity</label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1" style="width: 50%"> <br>
                            @error('quantity')
                                    {{$message}} <br> <br> 
                                    @enderror
                            <input type="submit" name="caddcart" value="Add To Cart">
                        </form>
                    </center>
                    </th>
                    @endforeach
                </tr>

            </table>
    
        </center>
    </div>
<div align="center">
    {{$p->links()}}
</div>
@endsection