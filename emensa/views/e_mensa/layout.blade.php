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
    @section('text')
    @show
    @section('gerichte')
    @show
    @section('misc')
    @show
</main>
@section('trennlinie')
@show
<footer>
    @section('footer')
    @show
</footer>
</body>


</html>