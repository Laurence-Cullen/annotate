@extends('master')

@section('content')
<div class="row">

    @foreach($images as $image)
        <div class="card col-xs-12 col-sm-6 col-md-3 col-lg-2 col-xl-2">
            <img id="{{ $image->hash }}" class="card-img-top img-fluid" src="{{ $image->URLRaw() }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">ID: {{ $image->id }}</h5>
                <button id="{{ $image->hash }}_button" type="button" class="btn btn-primary">Annotate</button>
                <p class="card-text">{{ $content }}</p>
                <p class="card-text">
                    <small class="text-muted">{{ $image->created_at->diffForHumans() }}</small>
                </p>
            </div>
        </div>

        <script>
            image = document.getElementById('{{ $image->hash }}');
            switchButton = document.getElementById(('{{ $image->hash }}_button'));

            switchButton.onclick = function (e) {
                if (image.src.valueOf() === "{{ $image->URLRaw() }}".valueOf()) {
                    image.src = "{{ $image->URLPredictions() }}";
                } else if (image.src.valueOf() === "{{ $image->URLPredictions() }}".valueOf()) {
                    image.src = "{{ $image->URLRaw() }}";
                } else {
                    console.log('failed to set new src value')
                }
            };

        </script>
    @endforeach

</div>

@endsection
