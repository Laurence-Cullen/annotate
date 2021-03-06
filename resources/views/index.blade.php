@extends('master')

@section('content')
    <div class="row">

        <script>
            //
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
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                <div class="card">

                    <a href="{{ url("/detail/" . $image['id']) }}">
                        <img
                            id="{{ $image['hash'] }}"
                            class="card-img-top img-fluid"
                            src="{{ $image->URLRaw() }}"
                            alt="Card image cap"
                        >
                    </a>
                    <div class="card-body">

                        <button
                            onclick="imageSwitcher(document.getElementById({{ $image->hash }}), '{{ $image->URLRaw() }}', '{{ $image->URLPredictions() }}')"
                            type="button"
                            class="btn btn-primary"
                        >
                            Annotate
                        </button>

                        <div class="card-text">
                            Detected:
                            @php
                                $objectNames = array_keys($detectionsMap[$image->id]);
                                $numberOfDetections = array_values($detectionsMap[$image->id]);
                            @endphp

                            @for($i=0; $i<count($objectNames); $i++)
                                @php
                                    if($i === count($objectNames) - 1) {
                                        $delim = ".";
                                    } else {
                                        $delim = ", ";
                                    }
                                @endphp

                                @if($numberOfDetections[$i] === 1)
                                    <a href="{{ url("/search?search-string=$objectNames[$i]") }}">
                                        {{ $numberOfDetections[$i] }} {{ $objectNames[$i] }}{{ $delim }}
                                    </a>

                                @else
                                    <a href="{{ url("/search?search-string=$objectNames[$i]") }}">
                                        {{ $numberOfDetections[$i] }} {{ $objectNames[$i] }}s{{ $delim }}
                                    </a>

                                @endif

                            @endfor
                        </div>
                        <p class="card-text">
                            <small class="text-muted">Uploaded by: {{ $image->user->name }}</small>
                            <small class="text-muted">{{ $image->created_at->diffForHumans() }}</small>
                        </p>

                    </div>
                </div>
            </div>

        @endforeach

    </div>
    <div class="row">
        {{ $images->links() }}
    </div>

@endsection
