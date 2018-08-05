@extends('layouts.adminLayout')
@section('content')
    <link href="{{asset('css/error.css')}}" type="text/css" rel="stylesheet">
    <div id="error">
        <ul>
            @foreach( $errors->all() as $error)
                <li> {{$error}} </li>
            @endforeach
        </ul>
    </div>

    <form id="form" style="margin: 20px;" action="{{ route('editMembershipType',['id' => $type->id]) }}" method="post"
          enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group ">
            <label for="name">Membership type name</label>
            <input type="text" class="form-control col-lg-5" id="name" name="name" placeholder="Enter name"
                   @if($errors->all()) value="{{old('name')}}" @else value="{{$type->name}}" @endif>
        </div>

        <div class="form-group ">
            <label for="price">Price</label>
            <input type="number" class="form-control col-lg-5" id="price" name="price" placeholder="Enter price"
                   @if($errors->all()) value="{{old('price')}}" @else value="{{$type->price}}" @endif>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection