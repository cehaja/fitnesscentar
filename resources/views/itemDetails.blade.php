@extends('layouts.mainLayout')
<link href="{{asset('css/itemDetails.css')}}" rel="stylesheet" type="text/css">

@section('content')

    <div class="container">
        <div style="display: inline-block;">
            <img src="{{asset('storage/itemImages/'.$item->image)}}" style="height: 450px; width: 450px;">
        </div>
        <div style="display: inline-block;">
            <p id="itemName">{{$item->name}}</p>
            <p id="itemPrice">{{$item->price.' €'}}</p>
            <p id="itemCategory">{{$item->category->name.'('.$item->subcategory->name.')'}}</p>
            <p id="itemManufacturer">{{$item->manufacturer}}</p>
            <p id="itemDescription">{{$item->description}}</p>
            <div>
                <form action="{{route('orderItemP')}}" method="post">
                    {{csrf_field()}}
                    <input type="text" name="id" hidden value="{{$item->id}}">
                    <div>
                        <i id="minus" class="fas fa-minus-circle"></i>
                        <input type="text" name="quantity" id="quantity" value="1">
                        <i id="plus" class="fas fa-plus-circle"></i>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin: 20px;">Add to cart</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{asset('js/itemDetails.js')}}"></script>

@endsection