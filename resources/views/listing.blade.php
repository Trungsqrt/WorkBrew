@extends('layout')

@section('content')
    <h1>{{ $listing['title'] }}</h1>
    <p>{{ $listing['description'] }}</p>

    @php
        error_log('listing id: ' . $listing['id']);
    @endphp
@endsection
