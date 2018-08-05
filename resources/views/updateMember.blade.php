@extends('layouts.adminLayout')
@section('content')
    <form id="form" style="margin: 20px;">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="firstName">First name</label>
            <input type="text" class="form-control col-lg-5" id="firstName" name="firstName"
                   placeholder="Enter first name" value="{{$member->firstName}}" readonly>
        </div>

        <div class="form-group ">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control col-lg-5" id="lastName" name="lastName" placeholder="Enter last name"
                   value="{{$member->lastName}}" readonly>
        </div>

        <div class="form-group">
            <label for="birthDate">Birth date</label>
            <input type="date" class="form-control col-lg-5" id="birthDate" name="birthDate"
                   value="{{$member->birthDate}}" readonly>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control col-lg-5" id="email" name="email" placeholder="Enter email"
                   value="{{$member->email}}" readonly>
        </div>

        <div class="form-group">
            <label for="membershipCardNumber">Membership card number</label>
            <input type="text" class="form-control col-lg-5" id="membershipCardNumber" name="membershipCardNumber"
                   placeholder="Enter membership card number" value="{{$member->membershipCardNumber}}" readonly>
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
            <a class="btn-primary btn" href="{{route('addMembership',['id' => $member->id])}}">Add membership</a>
        </div>
    </form>

@endsection