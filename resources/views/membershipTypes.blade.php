@extends('layouts.adminLayout')
@section('content')

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($types as $type)
            <tr>
                <td>{{$type->name}}</td>
                <td>{{$type->price.' €'}}</td>
                <td><a href="{{route('editMembershipType',['id' => $type->id])}}">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection