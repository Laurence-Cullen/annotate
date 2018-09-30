@extends('master')

@section('left_header')
    @include('allMyImages')
@endsection


@section('message_before_content')
Detail view:
@endsection


@section('content')
<div class="row">
    <div class="col-lg-6 col-xl-6 container">
        <div class="row">
            <p class="col-12">
                Original
            </p>
        </div>

        <img
            class="img-fluid col-12"
            src="{{ $image->URLRaw() }}"
            alt="Detailed view of non annotated image"
        >

    </div>
    <div class="col-lg-6 col-xl-6 container">
        <div class="row">
            <p class="col-12">
                Annotated
            </p>
        </div>

        <img
            class="img-fluid col-12"
            src="{{ $image->URLPredictions() }}"
            alt="Detailed view of annotated image"
        >

    </div>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            Detection summary:
        </div>
        <div class="col-3"></div>
    </div>

</div>
@endsection
