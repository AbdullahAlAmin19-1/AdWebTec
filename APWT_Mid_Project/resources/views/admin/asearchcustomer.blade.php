@extends('layouts.amain')
@section('title')
Profile
@endsection
@section('content')
<h1 align="center">Customer List</h1><center>
<div>
    <form action="{{route('public.searchproduct')}}" method="POST">
        {{@csrf_field()}}
        <input type="search" name="search_name" id="search_name" placeholder="Search here">
            @error('search_name')
            {{$message}}
            @enderror
        input type="submit" name="search" value="Search">
    </form>
</div>
<div>
@foreach ($customers as $user) 
                <tr> 
                    <th>
                        <center>
                            <img src="Customer images/{{$user->propic}}" alt="Customer Image" height="120px" width="120px">
                            <h3>{{$user->name}}</h3>
                            
                            <input type="hidden" name="id" id="id" value="{{$user->id}}"> <br>
                            <input type="submit" name="deletecustomer" value="Add To Cart">
                            </form>
                        </center>
                    </th>
                </tr>
                @endforeach
</div>
@endsection