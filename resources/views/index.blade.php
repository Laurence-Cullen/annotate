@extends('master')

@section('content')
    <div class="row">

        <script>
            function imageSwitcher(image, URLRaw, URLPredictions) {
                if (image.src === URLRaw) {
                    image.src = URLPredictions;
                } else if (image.src === URLPredictions) {
                    image.src = URLRaw;
                } else {
                    console.log('failed to set new src value for image')
                }
            }

        </script>

        @foreach($images as $image)
            <div class="card col-xs-12 col-sm-6 col-md-3 col-lg-2 col-xl-2">
                <img id="{{ $image->hash }}" class="card-img-top img-fluid" src="{{ $image->URLRaw() }}"
                     alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">ID: {{ $image->id }}</h5>

                    <button
                        onclick="imageSwitcher(document.getElementById({{ $image->hash }}), '{{ $image->URLRaw() }}', '{{ $image->URLPredictions() }}')"
                        type="button"
                        class="btn btn-primary"
                    >
                        Annotate
                    </button>

                    <p class="card-text">{{ $content }}</p>
                    <p class="card-text">
                        <small class="text-muted">{{ $image->created_at->diffForHumans() }}</small>
                    </p>
                </div>
            </div>
        @endforeach

    </div>

@endsection
