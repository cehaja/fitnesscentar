@extends('layouts.mainLayout')
@section('content')
    <link href="{{asset('css/error.css')}}" type="text/css" rel="stylesheet">
    <div id="error">
        <ul>
            @foreach( $errors->all() as $error)
                <li> {{$error}} </li>
            @endforeach
        </ul>
    </div>

    <div style="display: inline-block; width: 500px">
        <form style="margin: 20px;" action="{{route('profile')}}" method="post"
              enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="firstName">First name</label>
                <input type="text" class="form-control " id="firstName" name="firstName"
                       placeholder="Enter first name" value="{{$user->firstName}}">
            </div>

            <div class="form-group ">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control " id="lastName" name="lastName" placeholder="Enter last name"
                       value="{{$user->lastName}}">
            </div>

            <div class="form-group">
                <label for="birthDate">Birth date</label>
                <input type="date" class="form-control" id="birthDate" name="birthDate"
                       value="{{$user->birthDate}}">
            </div>

            @if(\Illuminate\Support\Facades\Auth::user()->type == 'member')
                <div class="form-group">
                    <label for="membershipCardNumber">Membership card number</label>
                    <input type="text" class="form-control " id="membershipCardNumber" name="membershipCardNumber"
                           placeholder="Enter membership card number" value="{{$user->membershipCardNumber}}" readonly>
                </div>

                <div class="form-group">
                    <label for="type">Membership type</label>
                    <input type="text" class="form-control " id="type" name="type"
                           value="{{$membership->type->name.' ('.$membership->type->price.')'}}" readonly>
                </div>

                <div class="form-group">
                    <label for="endDate">Membership expiration date</label>
                    <input type="date" class="form-control " id="endDate" name="endDate"
                           value="{{$membership->endDate}}" readonly>
                </div>
            @endif
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
    <div style="display: inline-block;">
        <form style="margin: 20px;" action="{{route('changePassword')}}" method="post"
              enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="oldPassword">Old password</label>
                <input type="password" class="form-control " id="oldPassword" name="oldPassword">
            </div>

            <div class="form-group">
                <label for="newPassword">New password</label>
                <input type="password" class="form-control " id="password" name="password">
            </div>

            <div class="form-group">
                <label for="confirmPassword">New password</label>
                <input type="password" class="form-control " id="password_confirmation" name="password_confirmation">
            </div>

            <button class="btn btn-primary">Change password</button>
        </form>
    </div>

@endsection