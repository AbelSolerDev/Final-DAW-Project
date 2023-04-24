@extends('layouts.app')

@section('content')
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
                                    <img src="{{ $image->image_path }}" class="img-fluid" alt="MobilHome photo" onclick="showImage('{{ $image->image_path }}')">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <br>

                    <p>{{ $mobilHome->description }}</p>
                    <p class="card-text">
                        @if ($mobilHome->discounted_price)
                            <span class="text-muted">{{ $mobilHome->price }}</span>
                            <span>{{ $mobilHome->discounted_price }}</span>
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
                            <a href="{{ route('admin.view-mobilhome') }}" class="btn btn-primary">Go to MobilHomes management</a>
                        @endif
                    @endif


                    <br>
                    <br>

                    <a href="{{ route('sale.index') }}" class="btn btn-primary">Back</a>
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




