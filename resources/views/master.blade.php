<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Annotate</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>
<body>


<div class="container">

    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <a href="{{ route('home') }}"><h1>Annotate</h1></a>
        </div>

        <div class="col-2">
            @if(Auth::check())
                <div class="dropdown">

                    <button
                        class="btn btn-secondary dropdown-toggle"
                        type="button"
                        id="dropdownMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        {{ Auth::user()->name }}
                    </button>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ url('/logout') }}">Log out</a>
                        <a class="dropdown-item" href="{{ route('myImages') }}">My images</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            @section('left_header')
                @if(Auth::check())
                    <a href="{{ route('myImages') }}">
                        <button type="button" class="btn btn-primary">My images</button>
                    </a>
                @endif
            @show
        </div>

        <form class="input-group mb-3 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" method="get"
              action="{{ route('search') }}">

            <input
                type="text"
                name="search-string"
                @yield('searchValue')
                class="form-control"
                placeholder="Search for an image containing..."
                aria-label="Search for image which contains"
                aria-describedby="basic-addon2"
            >

            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>

        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            @if(auth::check())
                <form action="{{ route('upload') }}"
                      method="post"
                      enctype="multipart/form-data"
                >

                    @section('currentRoute')
                        {{ Form::hidden('route', 'home') }}
                    @show
                    @csrf
                    <input type="file" name="image" value="image" id="image">
                    <input type="submit">
                </form>
            @else
                <a href="{{ route('login') }}">
                    <button type="button" class="btn btn-primary">Log in</button>
                </a>
                <a href="{{ route('register') }}">
                    <button type="button" class="btn btn-primary">Sign up</button>
                </a>
            @endif
        </div>
    </div>

    <div class="row">
        @yield('message_before_images')
    </div>

    <div class="row">

        @foreach($images as $image)
            <div class="card col-xs-12 col-sm-6 col-md-3 col-lg-2 col-xl-2">
                <img class="card-img-top img-fluid" src="/image/{{ $image->raw_path }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">{{ $content }}</p>
                    <p class="card-text">
                        <small class="text-muted">{{ $image->created_at->diffForHumans() }}</small>
                    </p>
                </div>
            </div>
        @endforeach

    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
</body>
</html>
