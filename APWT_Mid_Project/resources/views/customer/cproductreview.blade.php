@extends('layouts.main')
@section('title')
Customer Product Review
@endsection
@section('content')
<h1 align="center">Customer Product Review</h1>

<div class="main-section">
    <center>
        @foreach ($reviews as $item)

        <form action="{{route('customer.creviewForm')}}" method="POST">
            {{@csrf_field()}}
            <table border="1px" style="width:40%; border-collapse: collapse;">

                <input type="hidden" name="r_id" value="{{$item->id}}" style="width: 100%">

                <tr>
                    <th>Product ID</th>
                    <th>
                        <input type="text" name="p_id" value="{{$item->p_id}}" style="width: 100%" disabled>
                    </th>
                </tr>

                <tr>
                    <th>Product Name</th>
                    <th>
                        <input type="text" name="p_name" value="{{$item->name}}" style="width: 100%" disabled>
                    </th>
                </tr>

                <tr>
                    <th>Review Message</th>
                    <th>
                        <textarea name="r_message" cols="20" rows="4" style="width: 100%" placeholder="Write Your Review Here">{{$item->message}}</textarea>
                        <br> @error('r_message')
                        {{$message}} <br> <br> 
                        @enderror
                    </th>
                </tr>

                <tr>
                    <th colspan="2"><input type="submit" name="update" value="Update" style="width: 100%"></th>
                </tr>
            
            </table>
        </form>
            
        @endforeach
    </center>

</div>
@endsection
