@extends('layouts.amain')
@section('title')
Profile
@endsection
@section('content')
<h1 align="center">Customer List</h1><center>
<div>
    <form action="{{route('admin.asearchcustomer')}}" method="POST">
        {{@csrf_field()}}
        <input type="search" name="search_name" id="search_name" placeholder="Search here">
            @error('search_name')
            {{$message}}
            @enderror
        <input type="submit" name="search" value="Search">
    </form>
</div>
@endsection
