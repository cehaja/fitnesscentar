@extends('layouts.adminLayout')
@section('content')

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Email</th>
            <th scope="col">Membership end date</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
            @foreach($membersData as $member)
             <tr>
                <td>{{$member['firstName']}}</td>
                <td>{{$member['lastName']}}</td>
                <td>{{$member['email']}}</td>
                <td>{{$member['endDate']}}</td>
                 <td><a href="{{route('updateMember',['id' => $member['id']])}}">Details</a></td>
             </tr>
            @endforeach
        </tbody>
    </table>

@endsection