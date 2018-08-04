@extends('layouts.mainLayout')
@section('content')

    @if($orders != null)
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Items</th>
            <th scope="col">Order date</th>
            <th scope="col">Delivery date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>
                    @foreach($order->orderItems as $item)
                        {{$item->quantity.' X '.$item->item->name.' ('.$item->item->price.' € )'}}
                        <br>
                    @endforeach
                    {{'Total: '.$order->total.' €'}}
                </td>
                <td>{{$order->orderDate}}</td>
                <td>
                    @if($order->deliveryDate)
                        {{$order->deliveryDate}}
                        @else
                        Order has not been shipped!!
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
        @else
        <h5>You didn't complete any order!!</h5>
    @endif

@endsection