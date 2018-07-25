@extends('layouts.adminLayout')
@section('content')

    <form id="form" action="{{route('attendance')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group col-md-2">
            <label for="cardNumber">Card number</label>
            <input type="number" class="form-control col-sm-2" id="cardNumber" name="cardNumber"  autofocus>
        </div>
    </form>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th class="col">Member</th>
            <th scope="col">Arrival time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{$row['user']}}</td>
                <td>{{$row['arrivalTime']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
<script src="{{asset('js/attendance.js')}}"></script>
@endsection