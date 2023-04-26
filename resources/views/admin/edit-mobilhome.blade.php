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
                            <input type="hidden" name="_method" value="PUT">
                            <!--@method('PUT')-->
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
                                    <input id="price" type="number" step="0.01" class="form-control" name="price" value="{{ $mobilHome->price }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Discounted Price') }}</label>
                                <div class="col-md-6">
                                    <input id="discounted_price" type="number" step="0.01" class="form-control" name="price" value="{{ $mobilHome->discounted_price !== null ? $mobilHome->discounted_price : '' }}" disabled required>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="discount" class="col-md-4 col-form-label text-md-end">{{ __('Discount') }}</label>
                                <div class="col-md-6">
                                <select id="discount" name="discount" onchange="clearDiscountedPriceError()">
                                    <option value="" {{ $mobilHome->discount_percentage === null ? 'selected' : '' }}>No discount</option>
                                    @for ($i = 5; $i <= 95; $i += 5)
                                        @php
                                            $selected = ($mobilHome->discount_percentage !== null && $mobilHome->discount_percentage == $i) || ($mobilHome->discount_percentage === null && $i == 5);
                                        @endphp
                                        <option value="{{ $i }}" {{ $selected ? 'selected' : '' }}>{{ $i }}% discount</option>
                                    @endfor
                                </select>


                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 col-form-label text-md-end">
                                    <div class="custom-control custom-checkbox">
                                        <label class="custom-control-label" for="sold">{{ __('On Sale') }} = Sold</label>
                                        <input type="checkbox" class="custom-control-input" id="sold" name="sold" {{ $mobilHome->on_sale ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <label for="images">Images</label>
                                <input type="file" name="images[]" multiple>
                            </div>
                            <hr>
                            <table>
                                <thead>
                                    <div class="text-center">
                                        <h4>Existing images:</h4>
                                    </div>
                                    <tr>
                                        <th>Image</th>
                                        <th>Select to Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($mobilHome->images !== null)
                                    @foreach ($mobilHome->images as $image)
                                        <tr>
                                            <td>
                                                <img 
                                                    src="{{ $image->image_path ? '/storage/' . $image->image_path : '/storage/mobilhome_images/default.jpg' }}" 
                                                    class="img-fluid thumbnail-img small-img" 
                                                    alt="Photo of {{ $mobilHome->name }}"
                                                ></td>
                                            <td><input type="checkbox" name="images[]" value="{{ $image->id }}"></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <hr>

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
</div>

@endsection
