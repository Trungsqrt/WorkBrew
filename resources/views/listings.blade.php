@extends('layout')

@section('content')
    <h1>{{ $heading }}</h1>

    @forelse ($listings as $listing)
        <h2>
            <a href="/listings/{{ $listing['id'] }}">
                @php
                    error_log('welcome id: ' . $listing['id']);
                @endphp
                {{ $listing['title'] }}
                <br>

            </a>
        </h2>
        <p>{{ $listing['description'] }}</p>
    @empty
        <p>No listings found</p>
    @endforelse
@endsection
