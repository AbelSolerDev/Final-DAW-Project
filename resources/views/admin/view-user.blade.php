@extends('layouts.app')



@section('content')


        





    <div class="container">
            <div class="col-6">
                <a href="{{ route('admin.createUser') }}" class="btn btn-primary button-border">
                    Create User
                </a>
            </div>
    </div>
    <div class="container">
            <div class="col-6">
                <a href="{{ route('admin.index') }}" class="btn btn-success button-border">
                    back
                </a>
            </div>
        </div>



@endsection