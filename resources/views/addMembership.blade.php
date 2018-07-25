@extends('layouts.adminLayout')
@section('content')
<form id="form" style="margin: 20px;" action="{{ route('addMembership',['id' => $id]) }}" method="post"
      enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-md-12">
        <div class="form-group col-md-4">
            <label for="type">Membership type</label>
            <select class="form-control" id="type" name="type">
                @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->name.' ('.$type->price.')'}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group col-md-4">
            <label for="starDate">Start date</label>
            <input type="date" class="form-control" id="starDate" name="startDate">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group col-md-4">
            <label for="endDate">End date</label>
            <input type="date" class="form-control" id="endDate" name="endDate">
        </div>
    </div>

    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>

</form>
@endsection