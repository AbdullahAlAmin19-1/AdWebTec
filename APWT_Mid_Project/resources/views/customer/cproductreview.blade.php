@extends('layouts.main')
@section('title')
Customer Product Review
@endsection
@section('content')
<h1 align="center">Customer Product Review</h1>

<div class="main-section">
    <center>
        @foreach ($reviews as $item)

        <form action="#" method="POST">
            <table border="1px" style="width:40%; border-collapse: collapse;">

                <tr>
                    <th>Review ID</th>
                    <th>
                        <input type="text" name="r_id" value="{{$item->id}}" style="width: 100%" disabled>
                    </th>
                </tr>

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
                        <textarea name="r_messagw" cols="20" rows="4" style="width: 100%" placeholder="Write Your Review Here"></textarea>
                    </th>
                </tr>

                <tr>
                    <th colspan="2"><input type="submit" name="submit" value="Submit" style="width: 100%"></th>
                </tr>
            
            </table>
        </form>
            
        @endforeach
    </center>

</div>
@endsection
