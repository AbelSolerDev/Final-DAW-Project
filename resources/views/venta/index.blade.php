@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>{{ $title }}</h1>
        <p>{{ $description }}</p>
        <p>{{ $description2 }}</p>
        <ul>
            @foreach($mobilHomes as $mobilHome)
                <li>{{ $mobilHome }}</li>
            @endforeach
        </ul>
    </div>
@endsection
