@extends('layouts.app')

@section('content')


            <div class="text-center">
                <h1>{{$title}}</h1>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="lead about-us-text">{{$text1}}</p>
                            <img src="{{ asset('imagenes/aboutus/ilerna-online.jpg') }}" alt="logo" class="about-us-image img-fluid rounded-circle">
                            <div>
                                <p class="text-justify about-us-text">{{$text2}}</p>
                                <p class="text-justify about-us-text">{{$text3}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


@endsection