@extends('master')

@section('searchValue')
    value="{{ $searchString }}"
@endsection

@section('message_before_images')
    @if(count($images) == 0)
        <h1>Sorry! No images found containing a <strong>{{ $searchString }}</strong></h1>
    @endif
@endsection

@section('left_header')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <a href="{{ route('home') }}">
                    <button type="button" class="btn btn-primary">All images</button>
                </a>
            </div>
            <div class="col-6">
                @if(Auth::check())
                    <a href="{{ route('myImages') }}">
                        <button type="button" class="btn btn-primary">My Images</button>
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
