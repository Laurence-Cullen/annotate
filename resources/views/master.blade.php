<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Annotate</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ url("/css/master.css") }}">
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
            <div class="row">

                <div class="mb-3 col-xs-9 col-sm-9 col-md-9 col-lg-9 col-xl-9">

                    <input
                        id="search"
                        type="text"
                        name="search-string"
                        @yield('searchValue')
                        class="form-control"
                        placeholder="Search for an object..."
                        aria-label="Search for an object..."
                        aria-describedby="basic-addon2"
                        autocomplete="off">
                </div>

                <div class="input-group-append col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                    <button class="btn btn-info" type="submit">Search</button>
                </div>
            </div>
        </form>

        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
            @if(auth::check())
                @include('uploadModal')
            @else
                <div class="row">
                    <h3 class="centre-title">Upload an image?</h3>
                </div>
                <div class="row">
                    <div class="col-6">
                        @include('loginModal')
                    </div>
                    <div class="col-6">
                        @include('signUpModal')
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        @yield('message_before_content')
    </div>

    @yield('content')

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

<!-- Import typeahead.js -->
<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>

<!-- Initialize typeahead.js on the input -->
<script>
    $(document).ready(function () {
        var bloodhound = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '{{ route('find.object') }}?q=%QUERY%',
                wildcard: '%QUERY%'
            },
        });

        $('#search').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'detectable_objects',
            source: bloodhound,
            display: function (data) {
                return data.name  //Input value to be set when you select a suggestion.
            },
            templates: {
                empty: [
                    '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                ],
                header: [
                    '<div class="list-group search-results-dropdown">'
                ],
                suggestion: function (data) {
                    return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">' + data.name + '</div></div>'
                }
            }
        });
    });
</script>

</body>
</html>

