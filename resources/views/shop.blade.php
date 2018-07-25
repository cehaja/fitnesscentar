@extends('layouts.adminLayout')
@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th class="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td><img src="{{asset('storage/itemImages/'.$item->image)}}" style="height: 75px; height: 75px;"></td>
                <td>{{$item->name}}</td>
                <td>{{$item->price}}</td>
                <td><a href="{{route('orderItem',['id' => $item->id])}}">Order</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
