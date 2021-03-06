@extends('layouts.mainLayout')
@section('content')
    <link href="{{asset('css/error.css')}}" type="text/css" rel="stylesheet">
    <ul id="error" style="position: relative; bottom: 24px;">
        @foreach( $errors->all() as $error)
            <li> {{$error}} </li>
        @endforeach
    </ul>
    <!-- slide show -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"
         style="position: relative; bottom: 40px;">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{URL::asset('/assets/zoo1.jpg')}}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{URL::asset('/assets/zoo2.jpg')}}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{URL::asset('/assets/zoo3.jpg')}}" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@endsection