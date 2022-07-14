@extends('layouts.main')
@section('title')
Notice
@endsection
@section('content')
<h1 align="center">Notices</h1>
<div class="main-section">
    <center>
            <table style="width: 45%; margin:5px;" border="2px">
            {{@csrf_field()}}
            <tr style="padding: 10px;">
            <th>Notice From</th>
            <th>Mail</th>
            </tr>
            @foreach ($notices as $n)
            <tr>
                <td style="text-align: center;padding: 10px;"><b>{{$n->admin->name}}</b></td>
                <td style="padding: 10px;"><sup>Date & Time: {{$n->updated_at}}</sup><br><br><b>Subject:</b> {{$n->subject}}<br><b>Massage:</b> {{$n->massage}} </td>
            </tr>
            @endforeach
            </table>
    </center>

</div>
@endsection
