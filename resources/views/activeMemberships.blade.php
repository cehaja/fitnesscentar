@extends ('layouts.adminLayout')
@section('content')

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">User</th>
            <th scope="col">Type</th>
            <th scope="col">Start date</th>
            <th scope="col">End date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($actives as $active)
        <tr>
            <td>{{$active['user']}}</td>
            <td>{{$active['type']}}</td>
            <td>{{$active['startDate']}}</td>
            <td>{{$active['endDate']}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

@endsection