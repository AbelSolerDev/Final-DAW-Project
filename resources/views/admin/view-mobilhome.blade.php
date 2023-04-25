@extends('layouts.app')



@section('content')

    <div class="container">
        <div class="row">
            <div class="text-center">
                <h1>{{ $title }}</h1>
            </div>
            <div class="container my-2 text-center">
                <p>{{ $description }}</p>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('admin.index') }}" class="btn btn-success button-border">
                    Back
                </a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h3>List of Mobil Homes</h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('admin.createMobilHome') }}" class="btn btn-primary button-border">
                    Create Mobil Home
                </a>
            </div>
        </div>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 10%;">Image</th>
                    <th style="width: 15%;">Name</th>
                    <th style="width: 30%;">Description</th>
                    <th style="width: 10%;">Price</th>
                    <th style="width: 10%;">Available</th>
                    <th style="width: 10%;">Discounted Price</th>
                    <th style="width: 10%;">On Sale</th>
                    <th style="width: 10%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mobilHomes as $mobilHome)
                    <tr>    
                        <td><img src="{{ $mobilHome->images->first() ? '/storage/' . $mobilHome->images->first()->image_path : '/storage/mobilhome_images/default.jpg' }}" alt="Photo of {{ $mobilHome->name }}" class="img-fluid thumbnail-img"></td>
                        <!--<td><img src="{{ $mobilHome->images->first() ? asset($mobilHome->images->first()->image_path) : asset('storage/mobilhome_images/default.jpg') }}" alt="Photo of {{ $mobilHome->name }}" class="img-fluid thumbnail-img"></td>-->
                        <td>{{ $mobilHome->name }}</td>
                        <td>{{ Str::limit($mobilHome->description, $limit = 40, $end = '...') }}</td> 
                        <td>{{ $mobilHome->price }}&euro;</td>
                        <td>{{ $mobilHome->available ? 'Yes' : 'No' }}</td>
                        <td>{{ $mobilHome->discounted_price }}&euro;</td>
                        <td>{{ $mobilHome->on_sale ? 'Yes' : 'No' }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('sale.show', $mobilHome) }}" class="btn btn-info">Show</a>
                                <a href="{{ route('admin.editMobilHome', $mobilHome) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.deleteMobilHome', $mobilHome->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this mobil home?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection