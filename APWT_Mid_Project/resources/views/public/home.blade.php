@extends('layouts.main')
@section('title')
    Home
@endsection
@section('content')

    {{-- Customer Logout - Flash Message --}}
    <h3>{{Session::get('clogoutMsg')}}</h3>

    <h1 align="center">Online Groceries Ordering System</h1>
@endsection