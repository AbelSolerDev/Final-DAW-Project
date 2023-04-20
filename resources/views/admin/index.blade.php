@extends('layouts.app')


@section('content')

<!-- Crear Grid / Flexbox -->
<div class="container">
    <div class="row justify-content-between align-items-center text-center">
        <div class="col-6">
            <a href="{{ route('admin.createMobilHome') }}" class="btn btn-primary button-border">
                Crear Caravana
            </a>
        </div>
        <div class="col-6">
            <a href="{{ route('admin.createUser') }}" class="btn btn-success">
                Ver usuarios
            </a>
        </div>
    </div>
</div>


@endsection