<!DOCTYPE html>
<html lang="de">
<head>
    <title>@yield('title')</title>
    @section('head')
    @show
</head>
<body>
<header>
    @section('header')
    @show
    @section('nav')
    @show
</header>
<main>
    @section('main')
    @show
</main>
<footer>
    @section('footer')
    @show
</footer>
</body>
</html>