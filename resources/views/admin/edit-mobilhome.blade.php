@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Mobil Home') }}</div>
                    <div class="card-body">
                        <form action="{{ route('admin.editMobilHome', $mobilHome->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $mobilHome->name }}" required autofocus>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description">{{ $mobilHome->description }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>
                                <div class="col-md-6">
                                    <input id="price" type="number" step="0.01" class="form-control" name="price" value="{{ $mobilHome->discounted_price ?? $mobilHome->price }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="discount" class="col-md-4 col-form-label text-md-end">{{ __('Discount') }}</label>
                                <div class="col-md-6">
                                    <select id="discount" name="discount">
                                        <option value="" selected>No discount</option>
                                        <option value="0.05">5% discount</option>
                                        <option value="0.10">10% discount</option>
                                        <option value="0.15">15% discount</option>
                                        <option value="0.20">20% discount</option>
                                        <option value="0.25">25% discount</option>
                                        <option value="0.30">30% discount</option>
                                        <option value="0.35">35% discount</option>
                                        <option value="0.40">40% discount</option>
                                        <option value="0.45">45% discount</option>
                                        <option value="0.50">50% discount</option>
                                        <option value="0.55">55% discount</option>
                                        <option value="0.60">60% discount</option>
                                        <option value="0.65">65% discount</option>
                                        <option value="0.70">70% discount</option>
                                        <option value="0.75">75% discount</option>
                                        <option value="0.80">80% discount</option>
                                        <option value="0.85">85% discount</option>
                                        <option value="0.90">90% discount</option>
                                        <option value="0.95">95% discount</option>
                                    </select>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="sold" name="sold" {{ $mobilHome->on_sale ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sold">{{ __('On Sale') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="images">Images</label>
                                <input type="file" name="images[]" multiple>
                            </div>

                            @if ($mobilHome->images->count() > 0)
                                <h4>Existing images:</h4>
                                <ul>
                                    @foreach ($mobilHome->images as $image)
                                        <li>
                                            <img src="{{ $image->image_path ? '/storage/' . $image->image_path : '/storage/mobilhome_images/default.jpg' }}" class="img-fluid thumbnail-img" alt="Photo of {{ $mobilHome->name }}">
                                            <form action="{{ route('admin.deleteMobilHomeImage', [$mobilHome->id, $image->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Mobil Home') }}
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('admin.view-mobilhome') }}" class="btn btn-success button-border">
                                        {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection
