<div class="container">
    <div class="row">
        <div class="col-6">
            <a href="{{ route('home') }}">
                <button type="button" class="btn btn-primary">All images</button>
            </a>
        </div>
        <div class="col-6">
            @if(Auth::check())
                <a href="{{ route('myImages') }}">
                    <button type="button" class="btn btn-primary">My Images</button>
                </a>
            @endif
        </div>
    </div>
</div>
