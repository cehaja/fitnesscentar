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

    <form id="form" style="margin: 20px;" action="{{ route('addWorker') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group ">
            <label for="firstName">First name</label>
            <input type="text" class="form-control col-md-6" id="firstName" name="firstName"
                   placeholder="Enter first name" value="{{old('firstName')}}">
        </div>

        <div class="form-group">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control col-md-6" id="lastName" name="lastName" placeholder="Enter last name"
                   value="{{old('lastName')}}">
        </div>

        <div class="form-group">
            <label for="Birth date">Birth date</label>
            <input type="date" class="form-control col-md-6" id="birthDate" name="birthDate"
                   placeholder="Enter birth date" value="{{old('birthDate')}}">
        </div>

        <div class="form-group ">
            <label for="email">Email</label>
            <input type="email" class="form-control col-md-6" id="email" name="email" placeholder="Enter email"
                   value="{{old('email')}}">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control col-md-6" id="address" name="address" placeholder="Enter address"
                   value="{{old('address')}}">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}">
            </div>

            <div class="form-group col-md-4">
                <label for="country">Country</label>
                <select id="country" name="country" class="form-control">
                    @foreach($countries as $country)
                        <option value="{{$country->id}}"
                                @if($country->id == old('country')) selected @endif>{{$country->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" name="zip" value="{{old('zip')}}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>

    </form>

@endsection
