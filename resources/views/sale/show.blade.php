@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $mobilHome->name }}</div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($mobilHome->images as $image)
                            <div class="col-md-4 mb-3">
                                <div class="aspect-ratio" data-aspect-ratio="16/9">
                                    <img src="{{ $image->image_path ? '/storage/' . $image->image_path : '/storage/mobilhome_images/default.jpg' }}" class="img-fluid" alt="MobilHome photo" onclick="showImage('{{ '/storage/' . $image->image_path }}')">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <br>
                    <p>{{ $mobilHome->description }}</p>
                    <p class="card-text text-right">
                    @if ($mobilHome->on_sale)
                        <span class="text-danger font-weight-bold; font-size:100px;">SOLD</span>
                    @elseif (round($mobilHome->discount_percentage, 0) > 1 || $mobilHome->discounted_price > 1)
                        @if (round($mobilHome->discount_percentage, 0) !== 0)
                            <span style="text-decoration: line-through;">{{ $mobilHome->price }}&euro;</span>
                            <span style="color:red; font-size:20px;">{{ $mobilHome->discount_percentage }}%</span>
                        @endif
                        <span style="color:green; font-weight: bold; font-size:20px;">Now only for: {{ $mobilHome->discounted_price }}&euro;</span>
                    @else
                        <span>{{ $mobilHome->price }}&euro;</span>
                    @endif
                    </p>
                    <p>
                        @if ($mobilHome->available)
                            <span class="text-success font-weight-bold">Available!</span>
                        @endif
                    </p>
                    @if ($mobilHome->created_at)
                        <p>Publication date: {{ $mobilHome->created_at->format('d/m/Y') }}</p>
                    @endif

                    @if (!Auth::guest())
                        @if (Auth::user()->is_admin)
                            <a href="{{ route('admin.view-mobilhome') }}" class="btn btn-primary">Go to MobilHomes Management</a>
                        @endif
                    @endif
                    <br>
                    <br>

                    <a href="{{ route('sale.index') }}" class="btn btn-success">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeImage()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" alt="MobilHome photo" id="modalImage" class="d-block w-100">
            </div>
        </div>
    </div>
</div>

@endsection




