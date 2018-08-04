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
    <form id="form" style="margin: 20px;" action="{{ route('addMember') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="firstName">First name</label>
            <input type="text" class="form-control col-lg-5" id="firstName" name="firstName"
                   placeholder="Enter first name" value="{{old('firstName')}}">
        </div>

        <div class="form-group">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control col-lg-5" id="lastName" name="lastName" placeholder="Enter last name"
                   value="{{old('lastName')}}">
        </div>

        <div class="form-group">
            <label for="birthDate">Birth date</label>
            <input type="date" class="form-control col-lg-5" id="birthDate" name="birthDate"
                   value="{{old('birthDate')}}">
        </div>

        <div class="form-group">
            <label for="membershipCardNumber">Membership card number</label>
            <input type="text" class="form-control col-lg-5" id="membershipCardNumber" name="membershipCardNumber"
                   placeholder="Enter membership card number" value="{{old('membershipCardNumber')}}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control col-lg-5" id="email" name="email" placeholder="Enter email"
                   value="{{old('email')}}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control col-lg-5" id="password" name="password"
                   placeholder="Enter password">
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="type">Membership type</label>
                <select class="form-control" id="type" name="type">
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->name.' ('.$type->price.' KM)'}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="startDate">Start date</label>
                <input type="date" class="form-control" id="startDate" name="startDate" value="{{old('startDate')}}">
            </div>

            <div class="form-group col-md-3">
                <label for="endDate">End date</label>
                <input type="date" class="form-control" id="endDate" name="endDate" value="{{old('endDate')}}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>

    </form>

@endsection