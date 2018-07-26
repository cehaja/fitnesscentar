@extends('layouts.adminLayout')
@section('content')

    <form id="form" style="margin: 20px;" action="{{ route('editMembershipType',['id' => $type->id]) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group ">
            <label for="name">Membership type name</label>
            <input type="text" class="form-control col-lg-5" id="name" name="name" placeholder="Enter name" value="{{$type->name}}">
        </div>

        <div class="form-group ">
            <label for="price">Price</label>
            <input type="number" class="form-control col-lg-5" id="price" name="price" placeholder="Enter price" value="{{$type->price}}">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>

@endsection