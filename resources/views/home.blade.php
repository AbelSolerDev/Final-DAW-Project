@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
            <div class="text-center" style="position: relative;">
                <img src="{{ asset('imagenes/portada/imagenPortada2Retocada.jpg') }}" class="img-fluid rounded mx-auto d-block" alt="imagenPortada" style="max-width: 70%;">
                <h1 style="position: absolute; top: 30%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 6rem;">Bienvenido</h1>
                <!--<h3 style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 3rem;">Encuentra el mejor hogar para vivir</h3>-->
            </div>
</div>
@endsection
