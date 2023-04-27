@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="text-center">
        <h1>{{ $title }}</h1>
        <p>{{ $description }}</p>
        <p>{{ $description2 }}</p>
    </div>

    <div class="row publicaciónMobilHome">
        @php
            $saleIds = \App\Models\Sale::pluck('mobil_home_id')->toArray();
        @endphp
    <!-- MOBILHOME SIN VENDER / SIN DESCUENTO / SIN HACER LOGIN-->
        @foreach ($mobilHomes->items() as $mobilHome)
            @php
                $isOnSale = in_array($mobilHome->id, $saleIds);
            @endphp
            @if (!$isOnSale && !Auth::check() && $mobilHome->discounted_price < 1)
            <div class="col-md-4 col-lg-3 mb-4 mx-auto">
                <div class="card h-100">
                    @if ($mobilHome->images->count() > 0)
                    <img src="{{ $mobilHome->images->first() ? '/storage/' . $mobilHome->images->first()->image_path : '/storage/mobilhome_images/default.jpg' }}" alt="Photo of {{ $mobilHome->name }}" class="img-fluid thumbnail-img">
                    @else
                        No Images
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $mobilHome->name }}</h5>
                        <hr>
                        <p class="card-text">{{ Str::limit($mobilHome->description, $limit = 100, $end = '...') }}</p>
                        <hr>
                        <p class="card-text text-right">
                            <span>{{ $mobilHome->price }}&euro;</span>
                        </p>
                        <p>
                            @if ($mobilHome->available)
                                <span class="text-success font-weight-bold">Available!</span>
                            @endif
                        </p>
                    </div>
                    @if (auth()->check() && auth()->user()->is_admin)
                        <a 
                            href="{{ route('sale.show', $mobilHome) }}" 
                            class="btn btn-special {{ $mobilHome->on_sale ? 'enable' : '' }}" 
                            style="{{ $mobilHome->on_sale ? 'background-color: #ccc; color: #000;' : '' }}">
                                Know More
                        </a>
                    @else
                    <a 
                        href="{{ route('sale.show', $mobilHome) }}" 
                        class="btn btn-special {{ $mobilHome->on_sale ? 'disabled' : '' }}" 
                        style="{{ $mobilHome->on_sale ? 'background-color: #ccc; color: #000;' : '' }}">
                            Know More
                    </a>
                    @endif
                </div>
            </div>
            @endif
        @endforeach

           <!-- MOBILHOME SIN VENDER / CON DESCUENTO / CON LOGIN-->
    @if (Auth::check())
        @foreach ($mobilHomes->items() as $mobilHome)
            @php
                $isOnSale = in_array($mobilHome->id, $saleIds);
            @endphp
            @if (!$isOnSale)
            <div class="col-md-4 col-lg-3 mb-4 mx-auto">
                <div class="card h-100">
                    @if ($mobilHome->images->count() > 0)
                    <img src="{{ $mobilHome->images->first() ? '/storage/' . $mobilHome->images->first()->image_path : '/storage/mobilhome_images/default.jpg' }}" alt="Photo of {{ $mobilHome->name }}" class="img-fluid thumbnail-img">
                    @else
                        No Images
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $mobilHome->name }}</h5>
                        <hr>
                        <p class="card-text">{{ Str::limit($mobilHome->description, $limit = 100, $end = '...') }}</p>
                        <hr>
                        <p class="card-text text-right">
                        @if (!Auth::check() && $mobilHome->on_sale)
                            <span class="text-danger font-weight-bold; font-size:100px;">SOLD</span>
                        @endif
                        @if (Auth::check())
                            @if ($mobilHome->on_sale)
                                <span class="text-danger font-weight-bold; font-size:100px;">SOLD</span>
                            @elseif (round($mobilHome->discount_percentage, 0) > 1 || $mobilHome->discounted_price > 1)
                                @if (round($mobilHome->discount_percentage, 0) !== 0)
                                    <span style="text-decoration: line-through;">{{ $mobilHome->price }}&euro;</span>
                                    <span style="color:red; font-size:20px;">{{ $mobilHome->discount_percentage }}%</span>
                                @endif
                                <span style="color:green; font-weight: bold; font-size:20px;">{{ $mobilHome->discounted_price }}&euro;</span>
                            @else
                                <span>{{ $mobilHome->price }}&euro;</span>
                            @endif
                        @endif
                        </p>
                        <p>
                            @if ($mobilHome->available)
                                <span class="text-success font-weight-bold">Available!</span>
                            @endif
                        </p>
                    </div>
                    @if (auth()->check() && auth()->user()->is_admin)
                        <a 
                            href="{{ route('sale.show', $mobilHome) }}" 
                            class="btn btn-special {{ $mobilHome->on_sale ? 'enable' : '' }}" 
                            style="{{ $mobilHome->on_sale ? 'background-color: #ccc; color: #000;' : '' }}">
                                Know More
                        </a>
                    @else
                    <a 
                        href="{{ route('sale.show', $mobilHome) }}" 
                        class="btn btn-special {{ $mobilHome->on_sale ? 'disabled' : '' }}" 
                        style="{{ $mobilHome->on_sale ? 'background-color: #ccc; color: #000;' : '' }}">
                            Know More
                    </a>
                    @endif

                </div>
            </div>
            @endif
        @endforeach

    <!-- MOBILHOME VENDIDOS -->
        @foreach ($mobilHomes->items() as $mobilHome)
            @php
                $isOnSale = in_array($mobilHome->id, $saleIds);
            @endphp
            @if ($isOnSale)
            <div class="col-md-4 col-lg-3 mb-4 mx-auto">
                <div class="card h-100">
                    @if ($mobilHome->images->count() > 0)
                    <img src="{{ $mobilHome->images->first() ? '/storage/' . $mobilHome->images->first()->image_path : '/storage/mobilhome_images/default.jpg' }}" alt="Photo of {{ $mobilHome->name }}" class="img-fluid thumbnail-img">
                    @else
                        No Images
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $mobilHome->name }}</h5>
                        <hr>
                        <p class="card-text">{{ Str::limit($mobilHome->description, $limit = 100, $end = '...') }}</p>
                        <hr>
                        <p class="card-text text-right">
                        @if (!Auth::check() && $mobilHome->on_sale)
                            <span class="text-danger font-weight-bold; font-size:100px;">SOLD</span>
                        @endif
                        @if (Auth::check())
                            @if ($mobilHome->on_sale)
                                <span class="text-danger font-weight-bold; font-size:100px;">SOLD</span>
                            @elseif (round($mobilHome->discount_percentage, 0) > 1 || $mobilHome->discounted_price > 1)
                                @if (round($mobilHome->discount_percentage, 0) !== 0)
                                    <span style="text-decoration: line-through;">{{ $mobilHome->price }}&euro;</span>
                                    <span style="color:red; font-size:20px;">{{ $mobilHome->discount_percentage }}%</span>
                                @endif
                                <span style="color:green; font-weight: bold; font-size:20px;">{{ $mobilHome->discounted_price }}&euro;</span>
                            @else
                                <span>{{ $mobilHome->price }}&euro;</span>
                            @endif
                        @endif
                        </p>
                        <p>
                            @if ($mobilHome->available)
                                <span class="text-success font-weight-bold">Available!</span>
                            @endif
                        </p>
                    </div>
                    @if (auth()->check() && auth()->user()->is_admin)
                        <a 
                            href="{{ route('sale.show', $mobilHome) }}" 
                            class="btn btn-special {{ $mobilHome->on_sale ? 'enable' : '' }}" 
                            style="{{ $mobilHome->on_sale ? 'background-color: #ccc; color: #000;' : '' }}">
                                Know More
                        </a>
                    @else
                    <a 
                        href="{{ route('sale.show', $mobilHome) }}" 
                        class="btn btn-special {{ $mobilHome->on_sale ? 'disabled' : '' }}" 
                        style="{{ $mobilHome->on_sale ? 'background-color: #ccc; color: #000;' : '' }}">
                            Know More
                    </a>
                    @endif

                </div>
            </div>
            @endif
        @endforeach
    @endif

        <div class="d-flex justify-content-center">
        {{ $mobilHomes->onEachSide(3)->links() }}
        </div>
    </div>
</div>
@endsection


