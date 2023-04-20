@extends('layouts.app')


@section('content')
    <div class="text-center">
        <h1>{{ $title }}</h1>
    </div>
    <div class="container my-5 text-center">
        <p>{{ $description }}</p>
    </div>


    <!-- Crear Grid / Flexbox -->
    <div class="container">
        <div class="row justify-content-between align-items-center text-center">
            
            <div class="col-6">
                <a href="{{ route('admin.view-mobilhome') }}" class="btn btn-primary button-border">
                    View Mobil Homes
                </a>
            </div>
            <div class="col-6">
                <a href="{{ route('admin.view-user') }}" class="btn btn-primary">
                    View Users
                </a>
            </div>
        </div>
    </div>




@endsection