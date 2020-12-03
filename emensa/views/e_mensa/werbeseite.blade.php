@extends('e_mensa.layout')

@section('title')
    {{$title}}
@endsection

@section('header')
    Page 1

@endsection

@section('main')
    @forelse($data as $a)
        <li>
            {{$a['name']}}
            {{$a['preis_intern']}}
        </li>
    @empty
        <li>Es sind keine Gerichte vorhanden.</li>
    @endforelse
@endsection

@section('footer')
    Test Test Page 2
@endsection

{{--@section('head')
    <meta charset="UTF-8">
    <title>Werbeseite</title>
    <link rel="stylesheet" type="text/css" href="css/style_css.css">
    <!-- Icon Kit -->
    <script src="https://kit.fontawesome.com/2661bde70a.js" crossorigin="anonymous"></script>
@endsection

@section('header')
    <img id="Logo_neu" src="image/EMensa_Logo_neu.png" alt="Logo" width="300" height="175">
    <hr/>
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
@endsection


@section('begrüßung')
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


@section('gerichteÜbersicht')
    <!--Tabelle----------------------------------------------------------------------------->
    <section id="speisen">
        <h2>Köstlichkeiten, die Sie erwarten</h2>
        <table id="gerichtTabelle">
            <tr id="zeile1">
                <th></th>
                <th>Preis intern</th>
                <th>Preis extern</th>
            </tr>

            @while ($data)
            <tr>
                <td>{{$data['name']}}<span style='font-size: medium; float: right'>{{$row['code']}}</span></td>
                ";

                //Geld Format & tausche . gegen ,
                {{$number}} = <?php str_replace('.', ',', sprintf('%01.2f', {{$data['preis_intern']}}));?>
                <td>{{$number}}</td>

                //Geld Format & tausche . gegen ,
                {{$number}} = <?php str_replace('.', ',', sprintf('%01.2f', {{$data['preis_extern']}}));?>
                <td>{{$number}}</td>
            </tr>
            @endwhile
            //Letzte Zeile ausgeben
            <tr>
                <td> . . .</td>
                <td> ...</td>
                <td> ...</td>
            </tr>
        </table>
    </section>
@endsection


@section('footer')
    <footer>
        <ul>
            <li>(c) E-Mensa GmbH</li>
            <li>Fabian Kirchhoff & Glenn Verhaag</li>
            <li>Impressum</li>
        </ul>
    </footer>
@endsection--}}


