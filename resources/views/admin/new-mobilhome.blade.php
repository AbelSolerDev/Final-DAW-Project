@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add a new Mobilhome') }}</div>

                <div class="card-body">
                    <form action="{{ route('admin.storeMobilHome') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="number" step="0.01" class="form-control" name="price" value="{{ old('price') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="images">Imagenes</label>
                            <input type="file" name="images[]" multiple>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Mobil Home') }}
                                </button>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('admin.view-mobilhome') }}" class="btn btn-success button-border">
                                    back
                                </a>
                            </div>
                        </div>

                        <input type="hidden" name="available" value="1">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
