@extends('layouts.app')

@section('content')
<div class="text-center">
            <h1>{{ $title }}</h1>
        </div>
        <div class="container my-2 text-center">
            <p>{{ $description }}</p>
        </div>



    <div class="container mt-5">
        <form method="POST" action="{{ route('admin.updateUser', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="row justify-content-center">
                <div class="form-group col-md-9">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') ?? $user->name }}" required>
                </div>

                <div class="form-group col-md-9">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') ?? $user->email }}" required>
                </div>

                <div class="form-group col-md-9">
                    <label for="password">Password (optional)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group col-md-9">
                    <label for="password_confirmation">Confirm Password (optional)</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>
            <div class="mb-3 text-center">
            <button type="submit" class="btn btn-primary">Update User</button>
            </div>


        </form>
    </div>

        <div class="container">
            <div class="col-6">
                <a href="{{ route('admin.view-user') }}" class="btn btn-success button-border">
                    back
                </a>
            </div>
        </div>


@endsection
