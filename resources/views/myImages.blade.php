@extends('master')

@section('left_header')
    <a href="{{ route('home') }}">
        <button type="button" class="btn btn-primary">All images</button>
    </a>
@endsection


@section('message_before_images')
    @if(count($images) != 0)
        <h1>{{ Auth::user()->name }}'s gallery:</h1>
    @endif
@endsection

@section('currentRoute')
    {{ Form::hidden('route', 'myImages') }}
@endsection
