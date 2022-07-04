@extends('layouts.main')
@section('title')
    Welcome
@endsection
@section('content')
    <h1 align="center">Welcome</h1>
    <div>
            <table style="margin-left: 200px; margin-top: 100px">
                <tr>
                    <td>
                        <a href="{{route('admin.aviewcustomer')}}" style="font-size: 20px;">View Customers</a><br>
                        <a href="#" style="font-size: 20px;">View Vendor Profile</a><br>
                        <a href="#" style="font-size: 20px;">View Deliverymen</a><br>
                        <a href="#" style="font-size: 20px;">Approve Vouchers</a><br>
                    </td>
                </tr>
            </table>
    </div>
@endsection