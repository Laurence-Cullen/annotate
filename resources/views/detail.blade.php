@extends('master')

@section('left_header')
    @include('all_my_images_button')
@endsection

@section('message_before_content')
    <h3 class="centre-title col-12">Uploaded {{ $image->created_at->diffForHumans() }}</h3>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 container">
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
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 container">
            <div class="card">
                <img
                    class="img-fluid"
                    src="{{ $image->URLPredictions() }}"
                    alt="Detailed view of non annotated image"
                >

                <div class="card-body">
                    <h3 class="card-title">Annotated</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row container">

        <div class="row">
            <h3 class="col-12 centre-title">
                Similar images:
            </h3>
        </div>

        <div class="row">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(15).jpg"
                             alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(16).jpg"
                             alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(17).jpg"
                             alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

    </div>

@endsection
