@extends ('layouts.mainLayout')
@section('content')


    @if($orderItems == null)
    <h2>Order is empty</h2>
    @else
        {{csrf_field()}}
        <h3>Current order</h3>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>Image</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($orderItems as $orderItem)
                <tr>
                    <td><img src="{{asset('storage/itemImages/'.$orderItem->item->image)}}" style="height: 75px;"></td>
                    <td>{{$orderItem->item->name}}</td>
                    <td>{{$orderItem->item->category->name.'( '.$orderItem->item->subcategory->name.' )'}}</td>
                    <td>{{$orderItem->quantity}}</td>
                    <td class="itemPrice">{{($orderItem->item->price * $orderItem->quantity) . ' €'}}</td>
                    <td>Delete</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <h5 style="margin: 15px;">Total: <h5 id="price"></h5></h5>
        <a style="margin: 10px;" class="btn btn-primary" href="{{route('chooseAddress')}}">Complete order</a>
        <a style="margin: 10px;" class="btn btn-secondary" href="{{route('shop')}}">Continue shopping</a>
        <script src="{{asset('js/currentOrder.js')}}"></script>
    @endif

@endsection