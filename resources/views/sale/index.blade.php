@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>{{ $title }}</h1>
        <p>{{ $description }}</p>
        <p>{{ $description2 }}</p>
    </div>
    <div class="row publicaciónMobilHome">
        @foreach ($mobilHomes as $mobilHome)
            <div class="col-md-4 col-lg-3 mb-4 mx-auto">
                <div class="card h-100">
                    <img src="{{ $mobilHome->images->first() ? '/storage/' . $mobilHome->images->first()->image_path : '/storage/mobilhome_images/default.jpg' }}" alt="Photo of {{ $mobilHome->name }}" class="img-fluid thumbnail-img">
                    <!--<img src="{{ optional($mobilHome->images->first())->image_path }}" alt="Photo of {{ $mobilHome->name }}" class="img-fluid">-->
                    <div class="card-body">
                        <h5 class="card-title">{{ $mobilHome->name }}</h5>
                        <p class="card-text">{{ Str::limit($mobilHome->description, $limit = 100, $end = '...') }}</p>
                        <p class="card-text text-right" >
                            @if ($mobilHome->discounted_price)
                                <span class="text-muted">{{ $mobilHome->price }}</span>
                                <span>{{ $mobilHome->discounted_price }}</span>
                            @else
                                <span>{{ $mobilHome->price }}&euro;</span>
                            @endif
                            <span class="float-right">
                                @if ($mobilHome->available)
                                    <span class="text-success font-weight-bold">Available!</span>
                                @endif
                            </span>
                        </p>
                    </div>
                    <a href="{{ route('sale.show', $mobilHome) }}" class="btn btn-primary">Know More</a>
                </div>
            </div>
        @endforeach
    </div>
    {{ $mobilHomes->links() }}
@endsection


