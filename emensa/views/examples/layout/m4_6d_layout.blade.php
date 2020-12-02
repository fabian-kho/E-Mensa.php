<!DOCTYPE html>
<html lang="de">
<head>
    <title>@yield('title')</title>
</head>
<body>
    <header>
        @section('header')
            header
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