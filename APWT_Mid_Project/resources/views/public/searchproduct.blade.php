@extends('layouts.main')
@section('title')
    Products By Search
@endsection
@section('content')

    <h1 align="center">Online Groceries Ordering System</h1>

    <div class="product-section">
        <center>
    
            <table style="width: 40%;">
                <h3>-- Products By Search --</h3>
                
                @foreach ($products as $item) 
                <tr> 
                    <th>
                        <center>
                            <img src="product images/{{$item->thumbnail}}" alt="Product Image" height="120px" width="120px">
                            <h3>{{$item->name}}</h3>
                            <textarea style="width: 75%" disabled>{{$item->description}}</textarea>
                            <h4>Price: {{$item->price}} Taka.</h4>
                            <form action="{{route('customer.caddcart');}}" method="POST">
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
                </tr>
                @endforeach
    
            </table>
    
        </center>
    </div>

@endsection