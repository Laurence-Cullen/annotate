@extends('index')

@section('searchValue')
    value="{{ $searchString }}"
@endsection

@section('message_before_content')
    @if(count($images) == 0)
        <div class="container">
            <div class="row">
                <h1 class="col-12">Sorry! No images found containing a <strong>{{ $searchString }}</strong></h1>
            </div>
            <div class="row divider"></div>
            <div class="row">
                @if(count($similarDetectableObjects) > 0)
                    <div class="col-12">
                        <h2>Similar queries with matches:</h2>
                        @for($i=0; $i<count($similarDetectableObjects); $i++)
                            @php
                                $name = $similarDetectableObjects[$i]->name;
                                $score = $similarDetectableObjects[$i]->score;
                            @endphp

                            @if($score > 0)
                                <a href="{{ url("search?search-string=$name") }}">
                                    <h2>{{ $name }}</h2>
                                </a>
                            @endif
                        @endfor
                    </div>
                @endif

            </div>
            <div class="row divider"></div>
            <div class="row">

            </div>

        </div>

    @endif
@endsection

@section('left_header')
    @include('all_my_images_button')
@endsection
