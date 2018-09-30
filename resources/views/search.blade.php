@extends('index')

@section('searchValue')
    value="{{ $searchString }}"
@endsection

@section('message_before_content')
    @if(count($images) == 0)
        <h1>Sorry! No images found containing a <strong>{{ $searchString }}</strong></h1>

    @endif
@endsection

@section('left_header')
@include('allMyImages')
@endsection
