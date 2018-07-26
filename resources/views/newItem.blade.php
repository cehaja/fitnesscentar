@extends ("layouts.adminLayout")
@section('content')
    @include ('footer')
    <form id="form" action="{{ route('newItem') }}" method="post" enctype="multipart/form-data" onsubmit="return fun()">
        {{ csrf_field() }}

        <div class="form-group col-md-5">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
        </div>

        <div class="form-group col-md-5">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Enter price">
        </div>

        <div class="form-group col-md-5">
            <label for="manufacturer">Manufacturer</label>
            <input type="text" class="form-control" id="manufacturer" name="manufacturer" placeholder="Enter manufacturer">
        </div>

        <div class="form-group col-md-5">
            <label for="size">Size</label>
            <input type="text" class="form-control" id="size" name="size" placeholder="Enter size">
        </div>

        <div class="form-group col-md-7">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"></textarea>
        </div>

        <div class="form-group col-md-4">
            <label for="category">Category</label>
            <select id="category" name="category" class="form-control">
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="subcategory">Subcategory</label>
            <select id="subcategory" name="subcategory" class="form-control">
            </select>
        </div>

        <div class="form-group col-md-3">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/jpeg">
            <p id="error"></p>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
<script src="{{URL::asset('js/newItem.js')}}"></script>
    <script>
        function fun() {
            var name = $('#image').val().split('.');
            var ext =name[name.length-1];
            if (ext!='jpg'){
                $('#error').html('File must be .jpg');
                return false;
            }
            return true;
        }
    </script>


@endsection