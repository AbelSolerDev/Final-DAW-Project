@extends('layouts.app')



@section('content')


        





 
        <div class="container">
            <div class="col-6">
                <a href="{{ route('admin.createMobilHome') }}" class="btn btn-primary button-border">
                    Create Mobil Home
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