@extends('layouts.main')
@section('title')
Product Info
@endsection
@section('content')
<h1 align="center">Product Info</h1>

<div class="main-section">
    <center>
        <table border="2" style="width: 100%;">
            <tr>

                <td style="width: 50%; padding: 10px; padding-left: 170px;">

                    <img src="{{asset('storage/product_images')}}/{{$item->thumbnail}}" alt="Customer icon" style="width: 300px;">
                    <br> <br>

                </td>
                <td style="width: 50%; padding: 20px;">
                        
                        <fieldset>
                            <legend>Product Info</legend>
                            <table>
                                    <tr>
                                        <a href="{{route('public.viewproduct', ['id'=>$item->id])}}"><h3>{{$item->name}}</h3></a>
                                    </tr>
                                    <tr>
                                        <textarea style="width: 75%" disabled>{{$item->description}}</textarea>
                                    </tr>
                                    <tr>
                                        <h4>Price: {{$item->price}} Taka.</h4>
                                    </tr>
                                    <tr>
                                        <form action="{{route('customer.caddcart')}}" method="POST">
                                            {{@csrf_field()}}
                                            <input type="hidden" name="p_id" id="p_id" value="{{$item->id}}">
                                            
                                            @if(session()->get('user_type')=='Customer')
                                            <label for="quantity" style="width: 50%">Quantity</label>
                                            <input type="number" name="quantity" id="quantity" min="1" value="1"> <br> <br>
                                            @error('quantity')
                                                    {{$message}} <br>
                                                    @enderror
                                            <input type="submit" name="caddcart" value="Add To Cart" style="width: 40%;">
                                            
                                            @elseif(!session()->has('user_type'))
                                            <label for="quantity" style="width: 50%">Quantity</label>
                                            <input type="number" name="quantity" id="quantity" min="1" value="1"> <br> <br>
                                            @error('quantity')
                                                    {{$message}} <br>
                                                    @enderror
                                            <input type="submit" name="caddcart" value="Add To Cart" style="width: 40%;">
                                    
                                            @endif
                                            
                                        </form>
                                    </tr>
                            </table>
                        </fieldset>

                </td>
            </tr>
        </table>
    </center>

</div>
@endsection
