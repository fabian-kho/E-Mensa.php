@extends('e_mensa.layout')

@section('title','Wunschgericht')

@section('head')
    <meta charset="UTF-8">
    <title>Wunschgerichte</title>
    <link rel="stylesheet" type="text/css" href="css/wunschgerichte_style.css">
@endsection


@section('main')
    <div class="main">
        <p class="sign" align="center">Wunschgericht</p>
        <form class="form1" method="post">
            <label>
                <input class="name" name="name" type="text" placeholder="Name"/>
            </label>
            <label>
                <input class="email" type="email" name="email" align="center" placeholder="Email">
            </label>
            <label>
                <input class="gerichtName" name="gerichtName" type="text"  placeholder="Name des Gerichtes"/>
            </label>
            <label>
                <textarea class="beschreibung" name="beschreibung" placeholder="Beschreibung des Gerichtes"></textarea>
            </label>
            <input class="submit" name="submit" id="submit" type="submit" value="Wunsch abschicken"/>
            <br><br>
        </form>
    </div>
    <p id="fehlermeldung">@if(!empty($fehler_WG) && $fehler_WG!= 'stored'){{$fehler_WG}}
        @elseif($fehler_WG === 'stored') Wunschgericht wurde hinzugefügt!
        @endif
    </p>
@endsection
