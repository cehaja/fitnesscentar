@extends('layouts.mainLayout')
@section('content')

    @if($attendances == null)
        <h1>You have never benn in our gym</h1>
    @else
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>Date</th>
                <th>Member</th>
                <th>Arrival time</th>
            </tr>
            </thead>
            <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{$attendance->date}}</td>
                    <td>{{$attendance->arrivalTime}}</td>
                    <td>{{$attendance->exitTime}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection