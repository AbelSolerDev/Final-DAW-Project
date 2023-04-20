@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>{{ $title }}</h1>
        <p>{{ $description }}</p>
        <p>{{ $description2 }}</p>
    </div>
    <div class="row">
        @foreach ($mobilHomes as $mobilHome)
        <div class="mobil-home-box">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card mb-4">
                <img src="{{ $mobilHome->images->first()->image_path }}" alt="Photo of {{ $mobilHome->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $mobilHome->name }}</h5>
                        <p class="card-text">{{ $mobilHome->description }}</p>
                        <p class="card-text">
                            @if ($mobilHome->discounted_price)
                                <span class="text-muted">{{ $mobilHome->price }}</span>
                                <span>{{ $mobilHome->discounted_price }}</span>
                            @else
                                <span>{{ $mobilHome->price }}</span>
                            @endif
                        </p>
                        <p>
                            @if ($mobilHome->available)
                                <span>Disponible!</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
{{ $mobilHomes->links() }}
@endsection
