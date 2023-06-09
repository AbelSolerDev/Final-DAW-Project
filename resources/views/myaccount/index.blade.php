@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


<div class="container">

    <div class="text-center">
        <h1>My Account</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-6">
                <div class="card-body text-center">
                    <h5 class="card-title ">EDIT ACCOUNT INFO</h5>
                    <p class="card-text">Edit your account details.</p>
                    <a href="{{ route('myaccount.editUser') }}" class="btn btn-primary">Edit Account</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-6">
                <div class="card-body text-center">
                    <h5 class="card-title">DELETE ACCOUNT</h5>
                    <p class="card-text">Delete your account.</p>
                    <form action="{{ route('myaccount.deleteUser', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
