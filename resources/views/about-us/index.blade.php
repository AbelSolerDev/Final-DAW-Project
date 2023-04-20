@extends('layouts.app')

@section('content')


            <div class="text-center " >
                <h1>{{$title}}</h1>

                <div class="container my-5">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead">{{$text1}}</p>
                            <img src="{{ asset('imagenes/aboutus/ilerna-online.jpg') }}" alt="logo" style="max-width: 100%;">
                            <p class="text-justify">{{$text2}}</p>
                            <p class="text-justify">{{$text3}}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="blockquote">{{$text4}}</p>
                            <p class="blockquote">{{$text5}}</p>
                        </div>
                    </div>
                </div>
            </div>
@endsection