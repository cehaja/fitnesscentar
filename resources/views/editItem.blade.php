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
    @include ('footer')
    <form id="form" style="margin: 20px;" action="{{ route('editItem',['id' => $item->id]) }}" method="post"
          enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group col-md-5">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                   @if ($errors->all()) value="{{old('name')}}" @else value="{{$item->name}}" @endif>
        </div>

        <div class="form-group col-md-5">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Enter price"
                   @if ($errors->all()) value="{{old('price')}}" @else value="{{$item->price}}" @endif>
        </div>

        <div class="form-group col-md-5">
            <label for="manufacturer">Manufacturer</label>
            <input type="text" class="form-control" id="manufacturer" name="manufacturer"
                   placeholder="Enter manufacturer" @if ($errors->all()) value="{{old('manufacturer')}}"
                   @else value="{{$item->manufacturer}}" @endif>
        </div>

        <div class="form-group col-md-5">
            <label for="size">Size</label>
            <input type="text" class="form-control" id="size" name="size" placeholder="Enter size"
                   @if ($errors->all()) value="{{old('size')}}" @else value="{{$item->size}}" @endif>
        </div>

        <div class="form-group col-md-5">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"
                      placeholder="Enter description">@if ($errors->all()) value="{{old('description')}}
                " @else {{$item->description}} @endif</textarea>
        </div>

        <div class="form-group col-md-5">
            <label for="category">Category</label>
            <select id="category" name="category" class="form-control">
                @foreach($categories as $category)
                    <option value="{{$category->id}}"
                            @if($category->id == old('$category')) selected @endif>{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-5">
            <label for="subcategory">Subcategory</label>
            <select id="subcategory" name="subcategory" class="form-control">
            </select>
        </div>

        <div class="form-group col-md-5">
            <label for="image">Image</label>
            <img id="itemImage" src="{{asset('storage/itemImages/'.$item->image)}}"
                 style="height: 150px; width: 150px;"/>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/jpeg">
            <p id="error"></p>
        </div>


        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <script src="{{URL::asset('js/newItem.js')}}"></script>
    <script src="{{URL::asset('js/editItem.js')}}"></script>

@endsection