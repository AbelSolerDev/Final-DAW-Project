@extends('layouts.app')



@section('content')
            <div class="text-center">
                <h1>Create New User</h1>
            </div>

            <div class="container my-2">
                <form method="POST" action="{{ route('admin.storeUser') }}">
                    @csrf

                    <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </div>

                        <div class="mb-3">
                        <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        </div>

                        <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        </div>

                        <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="admin" name="admin">
                            <label class="form-check-label" for="admin">{{ __('Is admin?') }}</label>
                        </div>

                        <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary">{{ __('Create User') }}</button>
                        </div>


                    </div>
                    </div>
                </form>
                <div class="col-6">
                    <a href="{{ route('admin.view-user') }}" class="btn btn-success">
                        back
                    </a>
                </div>
                </div>
@endsection