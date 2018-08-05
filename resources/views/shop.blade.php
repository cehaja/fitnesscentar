@extends('layouts.mainLayout')
<link href="{{asset('css/shopCSS.css')}}" rel="stylesheet" type="text/css">
@section('content')
    {{csrf_field()}}
    @foreach($items as $item)
        <div class="itemContainer">
            <img class="itemImage" src="{{asset('storage/itemImages/'.$item->image)}}">
            <p class="itemName">{{$item->name}}</p>
            <p class="itemPrice">{{$item->price.' €'}}</p>
            <a class="btn btn-secondary detailsButton" href="{{route('itemDetails',['id' => $item->id])}}">Details</a>
            <a class="btn btn-primary orderButton" href="{{route('orderItemG',['id' => $item->id])}}">Add to cart</a>
        </div>
    @endforeach
@endsection
