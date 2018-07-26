@extends('layouts.adminLayout')
@section('content')

    <form id="form" style="margin: 20px;" action="{{ route('addCategory') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Category</label>
            <input type="text" class="form-control col-lg-5" id="name" name="name" placeholder="Enter name">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

@endsection