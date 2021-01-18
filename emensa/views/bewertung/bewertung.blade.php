@extends('e_mensa.layout')

@section('title','Bewertung')

@section('head')
        <!DOCTYPE html>
<html lang="de">
<head>

    <link rel="stylesheet" href="css/bewertung.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bars-movie/latest/css/bars-movie.min.css">
    <link rel="stylesheet" href="node_modules/jquery-bar-rating/dist/themes/bars-movie.css">

    <!-- Icon Kit -->
    <script src="https://kit.fontawesome.com/2661bde70a.js" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bewertung</title>
</head>
@endsection

@section('main')
    <body>
    <a href="/werbeseite"><button class="homebutton"><i class="fas fa-home"></i></button></a>

    <div class="grid-container">
    <div class="main">
        <p class="sign" align="center">Bewertung</p>
        <form class="form1" method="post">
            <textarea disabled class="gericht" type="text" name="gerichtName" align="center" placeholder="{{$array[0]->name}}">{{$array['namen']}}</textarea>
            <textarea class="bemerkung" type="text" name="bemerkung" align="center" placeholder="Bemerkung min. 5 Zeichen"></textarea>
            <div class="bewertung">
            <select id="example-movie" name="rating">
                <option value="0">sehr schlecht</option>
                <option value="1">schlecht</option>
                <option value="2">gut</option>
                <option value="3">sehr gut</option>
            </select>
                <nav class="abschicken"><button class="submit" name="submit" id="submit" type="submit" >Bewerten</button></nav>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
            <script src="node_modules/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
            <script type="text/javascript">
                $(function() {
                    $('#example-movie').barrating('show', {
                        theme: 'bars-movie'
                    });
                });
            </script>
        </form>
    </div>
        <div class="main"> @if(is_null($array[0]->bildname))
                <img class="gerichtbild" src="img/gerichte/00_image_missing.jpg">
            @else
                <img class="gerichtbild" src="img/gerichte/{{$array[0]->bildname}}">
            @endif
        </div>
    </div>
    <p id="fehlermeldung">@if(!empty($fehler_WG) && $fehler_WG!= 'stored'){{$fehler_WG}}
        @elseif($fehler_WG === 'stored') <text style="color: darkgreen">Bewertung wurde hinzugefügt wurde hinzugefügt!</text>
        @endif
    </p>
    </body>
</html>
@endsection