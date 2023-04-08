<!doctype html>
<html>

<head>

    <meta charset="utf-8">

    @vite(['resources/scss/app.scss'])

    <style>

    </style>

    <title>{{ config('app.name', 'XM-PHP') }}</title>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-lg-8"> @yield('content') </div>
    </div>
</div>

@vite(['resources/js/app.js'])

@stack('scripts')

</body>

</html>
