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
    @yield('body')

    @vite(['resources/js/app.js'])
</body>

</html>
