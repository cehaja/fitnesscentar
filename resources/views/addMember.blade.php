@extends('layouts.adminLayout')
@section('content')

    <form id="form" style="margin: 20px;" action="{{ route('addMember') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group col-md-6">
            <label for="firstName">First name</label>
            <input type="text" class="form-control col-sm-2" id="firstName" name="firstName" placeholder="Enter first name">
        </div>

        <div class="form-group col-md-6">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control col-sm-2" id="lastName" name="lastName" placeholder="Enter last name">
        </div>

        <div class="form-group col-md-12">
            <label for="birthDate">Birth date</label>
            <input type="date" class="form-control" id="birthDate" name="birthDate" style="width: 150px;">
        </div>

        <div class="form-group col-md-12">
            <label for="membershipCardNumber">Membership card number</label>
            <input type="text" class="form-control" id="membershipCardNumber" name="membershipCardNumber" placeholder="Enter membership card number">
        </div>

        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control col-sm-2" id="email" name="email" placeholder="Enter email">
        </div>

        <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" class="form-control col-sm-2" id="password" name="password" placeholder="Enter password">
        </div>



        <div class="form-group col-md-4">
            <label for="type">Membership type</label>
            <select class="form-control col-sm-2" id="type" name="type">
                @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->name.' ('.$type->price.' KM)'}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="startDate">Start date</label>
            <input type="date" class="form-control col-sm-2" id="startDate" name="startDate">
        </div>

        <div class="form-group col-md-4">
            <label for="endDate">End date</label>
            <input type="date" class="form-control col-sm-2" id="endDate" name="endDate">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>

    </form>

@endsection