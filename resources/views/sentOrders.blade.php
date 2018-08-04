@extends('layouts.adminLayout')
@section('content')

    @if($orders == null)
        <h5> There are no orders!!</h5>
    @else
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">User</th>
                <th scope="col">Items</th>
                <th scope="col">Address</th>
                <th scope="col">Order date</th>
                <th scope="col">Sent on date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>
                        {{$order->user->firstName.' '.$order->user->lastName}}
                    </td>
                    <td>
                        @foreach($order->orderItems as $item)
                            {{$item->quantity.' X '.$item->item->name.' ('.$item->item->price.' € )'}}
                            <br>
                        @endforeach
                        <hr>
                        {{'Total: '.$order->total.' €'}}
                    </td>
                    <td>
                        {{$order->address->address.'  '.$order->address->city.'  '.$order->address->ZIPCode.'  '.$order->address->country->name}}
                    </td>
                    <td>{{$order->orderDate}}</td>
                    <td>
                        {{$order->deliveryDate}}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif

@endsection