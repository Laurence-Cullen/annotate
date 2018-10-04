<div class="btn-group" role="group" aria-label="Basic example">

<a href="{{ route('home') }}">
    <button type="button" class="btn btn-primary">All images</button>
</a>
@if(Auth::check())
    <a href="{{ route('myImages') }}">
        <button type="button" class="btn btn-primary">My Images</button>
    </a>
@endif
</div>
