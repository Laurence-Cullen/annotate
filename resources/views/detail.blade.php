@extends('master')

@section('left_header')
    @include('all_my_images_button')
@endsection

@section('message_before_content')
    <h3 class="centre-title col-12">Uploaded {{ $image->created_at->diffForHumans() }}</h3>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <img
                    class="img-fluid"
                    src="{{ $image->URLRaw() }}"
                    alt="Detailed view of non annotated image"
                >

                <div class="card-body">

                    <h3 class="card-title">Original</h3>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <img
                    class="img-fluid"
                    src="{{ $image->URLPredictions() }}"
                    alt="Detailed view of annotated image"
                >

                <div class="card-body">
                    <h3 class="card-title">Annotated</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h3 class="centre-title">Similar images:</h3>
    </div>
    <div class="row">
        @foreach($image->similarImages(4) as $similarImage)
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                <a href="{{ route('detail', $similarImage->id) }}">
                    <img class="img-fluid" src="{{ $similarImage->URLRaw() }}" alt="Similar image to detailed view image">
                </a>
            </div>
        @endforeach
    </div>


@endsection
