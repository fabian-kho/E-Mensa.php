@extends('e_mensa.layout')


@section('title','E-Mensa')

@section('head')
    <title>Werbeseite</title>
    <link rel="stylesheet" type="text/css" href="css/style_css.css">

    <script type="text/javascript" src="slideshow.js"></script>

    <!-- Icon Kit -->
    <script src="https://kit.fontawesome.com/2661bde70a.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

@endsection

@section('header')


    <div class="topnav" id="myTopnav">
        <img class="logo" src="img/EMensa_Logo_neu.png" alt="Logo">
        <a href="#ankündigung">Ankündigung</a>
        <a href="#speisen">Speisen</a>
        <a href="#zahlen">Zahlen</a>
        <a href="#kontakt">Kontakt</a>
        <a href="#wichtig">Wichtig für uns</a>

        <button class="open-button" onclick="openForm()"><i class="far fa-user-circle" id="lock"></i></button>

        <div class="form-popup" id="myForm">
            <form action="/action_page.php" class="form-container">

                @if ($_SESSION['login_ok'])
                    <a href="/abmeldung">{{$_SESSION["name"]}} Abmelden</a>
                    <a href="/meinebewertungen">Meine Bewertungen</a>
                    <a href="/bewertungen">Alle Bewertungen</a>
                @else
                    <a href="/anmeldung">Anmelden</a>
                @endif
                <button type="button" class="btn cancel" onclick="openForm()">Close</button>
            </form>
        </div>

        <script>
            function openForm() {
                if (document.getElementById("myForm").style.display == "block")
                    document.getElementById("myForm").style.display = "none";
                else
                document.getElementById("myForm").style.display = "block";
            }

            function closeForm() {
                document.getElementById("myForm").style.display = "none";
            }
        </script>

        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>

    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>

@endsection

@section('main')

    <section id="ankündigung">
        <h1>Bald gibt es Essen auch online</h1>
        <p id="textfeld">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
            ut labore et dolore magna aliquyam erat,
            sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p>
    </section>

    @for($i=0;$i<$anzahlGerichte['anzahl'];$i)
        <div class="container ">
            <div class="box">
                @if(file_exists($bilder[$i]['bildname']))
                    <img src="img/gerichte/00_image_missing.jpg">
                @else
                    <img src="img/gerichte/{{$bilder[$i]['bildname']}}">
                @endif
                <span>{{$bilder[$i++]['name']}}</span>
            </div>
            <div class="box">
                @if(file_exists($bilder[$i]['bildname']))
                    <img src="img/gerichte/00_image_missing.jpg">
                @else
                    <img src="img/gerichte/{{$bilder[$i]['bildname']}}">
                @endif
                <span>{{$bilder[$i++]['name']}}</span>
            </div>
            <div class="box">
                @if(file_exists($bilder[$i]['bildname']))
                    <img src="img/gerichte/00_image_missing.jpg">
                @else
                    <img src="img/gerichte/{{$bilder[$i]['bildname']}}">
                @endif
                <span>{{$bilder[$i++]['name']}}</span>
            </div>
            <div class="box">
                @if(file_exists($bilder[$i]['bildname']))

                    <img src="img/gerichte/00_image_missing.jpg">
                @else
                    <img src="img/gerichte/{{$bilder[$i]['bildname']}}">
                @endif
                <span>{{$bilder[$i++]['name']}}</span>
            </div>
        </div>
    @endfor

    <script>
        var slideIndex = 0;
        showDivs(slideIndex);
        yourFunction();
    </script>

    <section id="speisen">
        <h2>Köstlichkeiten, die Sie erwarten</h2>
        <table id="gerichtTabelle">
            <tr id="zeile1">
                <th></th>
                <th>Preis intern</th>
                <th>Preis extern</th>
            </tr>
            @forelse($gerichte as $a)
                <td>{{$a['name']}} <span id="allergenCode">{{$a['code']}}</span></td>
                <td>{{$a['preis_intern']}}</td>
                <td>{{$a['preis_extern']}}</td>
                </tr>
            @empty
                <td>Leer!!!!!!!!!!</td></tr>
            @endforelse

        </table>
    </section>

    <!--Allergene-------------------------------------------------------------------------------------->
    <section id="Allergene">
        <i class="fas fa-allergies icon" id="lock"></i>
        <input title="Allergene anzeigen" type="checkbox" id="AllergenButton" name="AllergenButton" required>

        <ul id="AllergenListe" class="AllergenListe">
            @forelse($allergene as $a)
                <li><i class="fas fa-angle-right"></i>
                    {{$a['Allergen']}}
                    {{$a['Code']}}</li>
            @empty
                <td>Leer!!!!!!!!!!</td></tr>
            @endforelse
        </ul>

    </section>

    <!--Bewertungen-------------------------------------------------------------------------------------->
    <section id="Gerichtebewertung">
        <h7>Bewertung</h7>
        <p>Wählen Sie ein Gericht aus um es zu bewerten.</p>
        <form method="get" action="/bewertung">
            <fieldset>
                <div id="formular">
                    <i class="fas fa-star-half-alt icon"></i>
                    <label for="gerichtbewerten"></label><select name="gerichtbewerten" id="gerichtbewerten" size="1">
                        @forelse($gerichtnamen as $a)
                            <option value="{{$a['name']}}" >{{$a['name']}}</option>
                        @empty
                            <option value="Leer" selected>Leer</option>
                        @endforelse
                    </select>
                    <input name="bewertung" id="bewertung" type="submit" value="Bewerten"><br><br>
                </div>
            </fieldset>
        </form>
        <p id="fehler">{{$Alert}}
        </p>
    </section>


    <!--Wunschgericht-------------------------------------------------------------------------------------->

    <h6><a id="wunschgerichtLink" href="/wunschgerichte">Wunschgericht</a></h6>
    <p id="wunschgericht">Wenn Sie Gerichte haben die Sie sich wünschen, klicken Sie einfach auf die Überschrift um ihr
        persönliches Wunschgericht zu erstellen.
        Mit etwas Glück gibt es ihr Gericht schon bald bei uns im Angebot.</p>
    <!--Zahlen----------------------------------------------------->
    <section id="zahlen">
        <h3>E-Mensa in Zahlen</h3>
        <div id="zahl1"><p>{{$besucher}}</p>
            <p>Besuche</p></div>
        <div id="zahl2"><p>{{$anmeldungen}} </p>
            <p>Anmeldungen zum Newsletter</p></div>
        <div id="zahl3"><p>{{$anzahlGerichte['anzahl']}}</p>
            <p>Speisen</p></div>

    </section>

    <!--Newsletter----------------------------------------------------->
    <section id="kontakt">
        <h4>Interesse geweckt? Wir informieren Sie!</h4>
        <form method="post">
            <fieldset>

                <div id="formular">
                    <i class="fa fa-user icon"></i>
                    <label for="name"></label><input type="text" id="name" name="name" size="30"
                                                     placeholder="Bitte geben Sie Ihren Namen ein"
                                                     required>
                </div>

                <div id="formular">
                    <i class="fa fa-envelope icon"></i>
                    <label for="email"></label><input type="text" id="email" name="email" size="30"
                                                      placeholder="Bitte geben Sie Ihre E-Mail ein"
                                                      required>
                </div>

                <div id="formular">
                    <i class="fas fa-language icon"></i>
                    <label for="sprache"></label><select name="sprache" id="sprache" size="1">
                        <option value="English">English</option>
                        <option value="Deutsch" selected>Deutsch</option>
                        <option value="Denglisch">Denglisch</option>
                    </select>
                </div>

                <div id="formular">
                    <i class="fas fa-lock icon" id="lock"></i>
                    <input title="Zustimmung zum Datenschutz" type="checkbox" class="Datenschutz" name="Datenschutz"
                           required>
                </div>

                <div id="formular">
                    <input name="submit" id="submit" type="submit" value="Zum Newsletter anmelden"><br><br>
                </div>
            </fieldset>
        </form>
        <p id="fehler">@if(!empty($fehler) && $fehler!= 'stored'){{$fehler}}
            @elseif($fehler === 'stored') Erfolgreich zum Newsletter angemeldet!
            @endif
        </p>

    </section>

    <!--Wichtig----------------------------------------------------->
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



@section('footer')
    <hr>
    <ul>
        <li>(c) E-Mensa GmbH</li>
        <li>Fabian Kirchhoff & Glenn Verhaag</li>
        <li>Impressum</li>
    </ul>
@endsection



