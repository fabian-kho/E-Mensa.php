@extends('e_mensa.layout')

@section('title','Login')

@section('head')
<!DOCTYPE html>
<html lang="de">
<head>
    <link rel="stylesheet" href="css/Login.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Anmelden</title>
</head>
@endsection

@section('main')
<body>
<div class="main">
    <p class="sign" align="center">Anmelden</p>
    <form class="form1" method="get" action="/anmeldung_verifizieren">
        <input class="email" type="email" name="email" align="center" placeholder="Email">
        <input class="password" type="password" name="password" align="center" placeholder="Passwort">
        <button class="submit" type="submit" align="center">Anmelden</button>
        <br><br>
         <p class="error">{{$msg}}</p>
    </form>
</div>

</body>
</html>
@endsection