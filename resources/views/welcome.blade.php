@extends('layouts.app')

@section('content')
<div class="text-center welcome-container">
    <h1 class="welcome-title">Welcome</h1>
    <img src="{{ asset('imagenes/portada/imagenPortada2Retocada.jpg') }}" class="img-fluid rounded-circle img-thumbnail mx-auto d-block" alt="imagenPortada" style="max-width: 30%; object-fit: cover;">
    <p class="welcome-text">Welcome to the portal where you can view the best Mobil-Homes for sale. 
     <br> If you register, you can see the Mobil-Homes on discount.
    </p>
    <a href="{{ route('sale.index') }}" class="btn welcome-btn">Get Started</a>
</div>
@endsection
