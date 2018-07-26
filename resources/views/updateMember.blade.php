@extends('layouts.adminLayout')
@section('content')

    <form id="form" style="margin: 20px;" action="{{ route('updateMember',['id' => $member->id]) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="firstName">First name</label>
            <input type="text" class="form-control col-lg-5" id="firstName" name="firstName" placeholder="Enter first name" value="{{$member->firstName}}">
        </div>

        <div class="form-group ">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control col-lg-5" id="lastName" name="lastName" placeholder="Enter last name" value="{{$member->lastName}}">
        </div>

        <div class="form-group">
            <label for="birthDate">Birth date</label>
            <input type="date" class="form-control col-lg-5" id="birthDate" name="birthDate" value="{{$member->birthDate}}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control col-lg-5" id="email" name="email" placeholder="Enter email" value="{{$member->email}}">
        </div>

        <div class="form-group">
            <label for="membershipCardNumber">Membership card number</label>
            <input type="text" class="form-control col-lg-5" id="membershipCardNumber" name="membershipCardNumber" placeholder="Enter membership card number" value="{{$member->membershipCardNumber}}">
        </div>

        <div class="form-group">
            <label for="type">Membership type</label>
            <input type="text" class="form-control col-lg-5" id="type" name="type" value="{{$type->name.' ('.$type->price.')'}}" readonly>
        </div>

        <div class="form-group">
            <label for="endDate">Membership expiration date</label>
            <input type="date" class="form-control col-lg-5" id="endDate" name="endDate" value="{{$membership->endDate}}" readonly>
        </div>

        <div class="form-group">
            <a href="{{route('addMembership',['id' => $member->id])}}">Add membership</a>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

@endsection