<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Guestbook')</title>
    <link href="{{ asset('resources/css/app.css') }}" rel="stylesheet" type="text/css" >

    @vite(['resources/sass/app.scss', 'resources/css/app.css'])

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">GB</a>
        <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
                >
                <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ route('guests.index') }}" class="nav-link">
                        Guests
                    </a>
                </li>
            </ul>
        </div>
        </div>
    </nav>

    @yield('body')

    @vite(['resources/js/app.js'])
</body>

</html>
