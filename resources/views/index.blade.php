@extends('master')

@section('content')
<div class="row">

    @foreach($images as $image)
        <div class="card col-xs-12 col-sm-6 col-md-3 col-lg-2 col-xl-2">
            <img id="{{ $image->hash }}" class="card-img-top img-fluid" src="/image/{{ $image->raw_path }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">ID: {{ $image->id }}</h5>
                <p class="card-text">{{ $content }}</p>
                <p class="card-text">
                    <small class="text-muted">{{ $image->created_at->diffForHumans() }}</small>
                </p>
            </div>
        </div>

        <script>
            document.getElementById('{{ $image->hash }}');
        </script>
    @endforeach

</div>

@endsection
