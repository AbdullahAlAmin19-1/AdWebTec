@extends('layouts.main')
@section('title')
    Coupon
@endsection
@section('content')
    <h1 align="center">Create Coupon</h1>
    <center>
    <h1>{{Session::get('msg')}}</h1>
            <form action="" method="POST">
                <table style="width: 30%;">
                {{@csrf_field()}}
                    <tr>
                        <th><label for="codetype">Code Generation:</label></th>
                        <td>
                            <input type="radio" id="auto" name="codetype" value="auto"><label for="auto">Auto</label>
                            <input type="radio" id="manual" name="codetype" value="manual"><label for="manual">Manual</label>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="code">Coupon Code / Size:</label></th>
                        <td><input type="text" id='code' name="code" placeholder="Generate Coupon Code" value="{{old('code')}}"></td>
                    </tr>
                    <tr>
                        <th><label for="amount">Discount Amount:</label></th>
                        <td><input type="number" id='amount' name="amount" placeholder="Enter Discount Amount" value="{{old('amount')}}"></td>
                    </tr>
                    <tr>
                        <th colspan="2"><input type="submit"value="Create"></tH>
                    </tr>               
                </table>
            </form>  
    </center>
@endsection