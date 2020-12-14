@extends('e_mensa.layout')

@section('title','Wunschgericht')

@section('head')
    <meta charset="UTF-8">
    <title>Wunschgerichte</title>
    <link rel="stylesheet" type="text/css" href="css/wunschgerichte_style.css">
@endsection

@section('header')
    <!-- Hover #1 -->
    <div class="box-1">
        <div class="btn">
            <input id="input" type="button" value="Startseite!" onclick="history.back(-1)" />
        </div>
    </div>

@endsection

@section('main')
    <h1>Wunschgericht</h1>
    <form method="post">
        <label>
            <input name="name" type="text" class="feedback-input" placeholder="Name"/>
        </label>
        <label>
            <input name="email" type="text" class="feedback-input" placeholder="Email"/>
        </label>
        <label>
            <input name="gerichtName" type="text" class="feedback-input" placeholder="Name des Gerichtes"/>
        </label>
        <label>
            <textarea name="beschreibung" class="feedback-input" placeholder="Beschreibung des Gerichtes"></textarea>
        </label>
        <input name="submit" id="submit" type="submit" value="Wunsch abschicken"/>
    </form>
    <p id="fehlermeldung">@if(!empty($fehler_WG) && $fehler_WG!= 'stored'){{$fehler_WG}}
        @elseif($fehler_WG === 'stored') Wunschgericht wurde hinzugefügt!
        @endif
    </p>

    <hr>
@endsection

@section('footer')
    <footer>
        <ul>
            <li>(c) E-Mensa GmbH</li>
            <li>Fabian Kirchhoff & Glenn Verhaag</li>
            <li>Impressum</li>
        </ul>
    </footer>
@endsection