<!DOCTYPE html>
<html lang="en">
<head>
    <title>Screening Test @yield('title')</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @section('css')
        <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    @show
</head>
<body class="courses-page">
@include('layouts.header')
@yield('content')
@include('layouts.footer')
@section('js')
    <script type='text/javascript' src='{{ asset("js/app.js") }}'></script>
@show
</body>
</html>
