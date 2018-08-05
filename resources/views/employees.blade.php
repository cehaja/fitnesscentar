@extends('layouts.adminLayout')
@section('content')

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Email</th>
            <th scope="col">Birth date</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($employees as $employee)
            <tr>
                <td>{{$employee->firstName}}</td>
                <td>{{$employee->lastName}}</td>
                <td>{{$employee->email}}</td>
                <td>{{$employee->birthDate}}</td>
                <td><a href="{{route('editEmployee',['id' => $employee->id])}}">Edit</a></td>
                <td><a href="{{route('deleteEmployee',['id' => $employee->id])}}">Delete</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection