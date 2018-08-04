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
    <form id="form" style="margin: 20px;" action="{{ route('updateMember',['id' => $member->id]) }}" method="post"
          enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="firstName">First name</label>
            <input type="text" class="form-control col-lg-5" id="firstName" name="firstName"
                   placeholder="Enter first name" @if($errors->all()) value="{{old('firstName')}}"
                   @else value="{{$member->firstName}}" @endif>
        </div>

        <div class="form-group ">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control col-lg-5" id="lastName" name="lastName" placeholder="Enter last name"
                   @if($errors->all()) value="{{old('lastName')}}"
                   @else value="{{$member->lastName}}" @endif>
        </div>

        <div class="form-group">
            <label for="birthDate">Birth date</label>
            <input type="date" class="form-control col-lg-5" id="birthDate" name="birthDate"
                   @if($errors->all()) value="{{old('birthDate')}}"
                   @else value="{{$member->birthDate}}" @endif>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control col-lg-5" id="email" name="email" placeholder="Enter email"
                   @if($errors->all()) value="{{old('email')}}"
                   @else value="{{$member->email}}" @endif>
        </div>

        <div class="form-group">
            <label for="membershipCardNumber">Membership card number</label>
            <input type="text" class="form-control col-lg-5" id="membershipCardNumber" name="membershipCardNumber"
                   placeholder="Enter membership card number"  @if($errors->all()) value="{{old('membershipCardNumber')}}"
                   @else value="{{$member->membershipCardNumber}}" @endif>
        </div>

        <div class="form-group">
            <label for="type">Membership type</label>
            <input type="text" class="form-control col-lg-5" id="type" name="type"
                   value="{{$type->name.' ('.$type->price.')'}}" readonly>
        </div>

        <div class="form-group">
            <label for="endDate">Membership expiration date</label>
            <input type="date" class="form-control col-lg-5" id="endDate" name="endDate"
                   value="{{$membership->endDate}}" readonly>
        </div>

        <div class="form-group">
            <a href="{{route('addMembership',['id' => $member->id])}}">Add membership</a>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

@endsection