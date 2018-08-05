@extends('layouts.adminLayout')
@section('content')

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Subcategories</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category['category']}}</td>
                <td>{{$category['subcategories']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection