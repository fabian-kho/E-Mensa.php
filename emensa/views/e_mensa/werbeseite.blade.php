@extends('e_mensa.layout')

@section('title','E-Mensa')

@section('head')
    <meta charset="UTF-8">
    <title>Werbeseite</title>
    <link rel="stylesheet" type="text/css" href="css/style_css.css">
    <!-- Icon Kit -->
    <script src="https://kit.fontawesome.com/2661bde70a.js" crossorigin="anonymous"></script>
@endsection

@section('header')
    <img id="Logo_neu" src="img/EMensa_Logo_neu.png" alt="Logo" width="300" height="175">
@endsection

@section('nav')
    <nav id="Links">
        <ul>
            <li><a href="#ankündigung">Ankündigung</a></li>
            <li><a href="#speisen">Speisen</a></li>
            <li><a href="#zahlen">Zahlen</a></li>
            <li><a href="#kontakt">Kontakt</a></li>
            <li><a href="#wichtig">Wichtig für uns</a></li>
        </ul>
    </nav>
    <hr/>
@endsection

@section('text')

    <section id="ankündigung">
        <h1>Bald gibt es Essen auch online ;)</h1>
        <p id="textfeld">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
            ut labore et dolore magna aliquyam erat,
            sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no
            sea takimata sanctus est Lorem ipsum dolor
            sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
            labore et dolore magna aliquyam erat,
            sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no
            sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
    </section>

@endsection

@section('gerichte')
    <section id="speisen">
        <h2>Köstlichkeiten, die Sie erwarten</h2>
        <table id="gerichtTabelle">
            <tr id="zeile1">
                <th></th>
                <th>Preis intern</th>
                <th>Preis extern</th>
            </tr>
            @forelse($data as $a)
                <td>{{$a['name']}} <span style='font-size: medium; float: right'>{{$a['code']}}</span></td>
                <td>{{$a['preis_intern']}}</td>
                <td>{{$a['preis_extern']}}</td>
                </tr>
            @empty
                <td>Leer!!!!!!!!!!</td></tr>
            @endforelse
        </table>
    </section>
@endsection

@section('misc')
    <section id="wichtig">
        <h5>Das ist uns Wichtig</h5>
        <ul>
            <li><i class="fas fa-angle-right"></i>Beste frische Saisonale Zutaten</li>
            <li><i class="fas fa-angle-right"></i>Ausgewogene abwechslungreiche Gerichte</li>
            <li><i class="fas fa-angle-right"></i>Sauberkeit</li>
        </ul>
    </section>

    <p>Wir freuen uns auf Ihren Besuch!</p>
@endsection

@section('trennlinie')
    <hr>
@endsection

@section('footer')
    <ul>
        <li>(c) E-Mensa GmbH</li>
        <li>Fabian Kirchhoff & Glenn Verhaag</li>
        <li>Impressum</li>
    </ul>
@endsection



