<?php
/**
 * Praktikum DBWT. Autoren:
 * Fabian, Kirchhoff, 3191755
 * Glenn, Verhaag, 3173673
 */

/****Newsletter*************************/


$blacklist = [  1 => 'rcpt.at',
                2 => 'damnthespam.at',
                3 => 'wegwerfmail.de',
                4 => 'trashmail.de',
                5 => 'trashmail.com'];

function find_text_in_array(array $array, $text) : bool {
    foreach ($array as $key => &$value) {
        if (strpos($text, $value) !== false) {
            return true;
        }
    }
    return false;
}


if(isset($_POST['submit'])) {

    $newsletter =[
        'name' => trim($_POST['name']?? NULL), //gesetzt?
        'email' => trim($_POST['email']?? NULL),
        'sprache' => trim($_POST['sprache']?? NULL),
        'datenschutz' => $_POST['Datenschutz'] ?? NULL
    ];

    $fehler = false;

    //Prüfen ob leer?
    if (empty($newsletter['name'])) {
        $fehler = 'Der Name darf nicht leer sein.';
    }

    //E-Mail validierung
    if (!filter_var($newsletter['email'], FILTER_VALIDATE_EMAIL)) {
        $fehler = 'Die E-Mail hat das falsche Format.';
        if (empty($newsletter['email'])) {
            $fehler = 'Die E-Mail darf nicht leer sein.';
        }
    }

    if (find_text_in_array($blacklist,$newsletter['email'])) {
        $fehler = 'Diese E-Mail ist nicht zulässig.';
    }

    //Store
    if(!$fehler)
    $Userdata = file_put_contents('./data.txt', serialize($newsletter)."\r\n", FILE_APPEND);
}

/****Zähler*************************/

$dateiname = "besucher.txt";
$counter = fopen ($dateiname, "r");
$aufrufe = fread ($counter, filesize ($dateiname)); //alten counter einlesen
fclose ($counter);

$aufrufe=$aufrufe+1; //counter um 1 erhöhen

$counter = fopen ("besucher.txt", "w");
fwrite ($counter, $aufrufe); //neuen counter speichern
fclose ($counter);

$anmeldungen = 0;
$file="data.txt";
$handle = fopen($file, "r");
while(!feof($handle)){
    $line = fgets($handle);
    $anmeldungen++;
}
fclose($handle);

?>

<!DOCTYPE html>
<!--
- Praktikum DBWT. Autoren:
- Fabian, Kirchhoff, 3191755
- Glenn, Verhaag, 3173673
-->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Werbeseite</title>
    <link rel="stylesheet" type="text/css" href="css/style_css.css">
    <!-- Icon Kit -->
    <script src="https://kit.fontawesome.com/2661bde70a.js" crossorigin="anonymous"></script>
</head>
<body>
        <!--<section id="Logo">E-Mensa</section>-->
        <img id="Logo_neu" src="image/EMensa_Logo_neu.png." alt="Logo" width="300" height="175">
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
    <!--Main----------------------------------------------------->
    <main>
        <section id="ankündigung">
            <h1>Bald gibt es Essen auch online ;)</h1>
            <p id="textfeld">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor
                sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        </section>
        <!--Tabelle----------------------------------------------------->
        <section id="speisen">
            <h2>Köstlichkeiten, die Sie erwarten</h2>
            <table id="sptable" >
                <tr id="zeile1">
                    <th></th>
                    <th>Preis intern</th>
                    <th>Preis extern</th>
                </tr>
                <?php
                        $meals=unserialize(file_get_contents('./Meal/meals.txt')); //Daten aus Datei einlesen
                        foreach ($meals as $meal => $arrays){
                            foreach ($arrays as $type => $content){
                                switch ($type){
                                    case "name":
                                        echo "<tr><td>{$content}</td>";
                                        break;
                                    case "price_intern":
                                        echo "<td>{$content}</td>";
                                        break;
                                    case "price_extern":
                                        echo "<td>{$content}</td></tr>";
                                        break;
                                    case "image":
                                        echo   "<img class='image' src='./image/{$content}' width='250' height='175' style='margin:10px 0px 20px 20px' align='left'>";
                                    default:
                                        
                                }
                            }
                        }
                    ?>


            </table>
        </section>
        <!--Zahlen----------------------------------------------------->
        <section id="zahlen">
                <h3>E-Mensa in Zahlen</h3>
                <div id="zahl1"><p><?php echo $aufrufe ?></p> <p>Besuche</p></div>
                <div id="zahl2"><p><?php echo $anmeldungen?></p> <p>Anmeldungen zum Newsletter</p></div>
                <div id="zahl3"><p><?php echo count($meals) ?></p> <p>Speisen</p></div>

        </section>
        <!--Newsletter----------------------------------------------------->
        <section id="kontakt">
                <h4>Interesse geweckt? Wir informieren Sie!</h4>
            <form method="post" >
                <fieldset>

                    <i class="fa fa-user icon"></i>
                    <input type="text" id="name" name="name" size="30" placeholder="Bitte geben Sie Ihren Namen ein" required>
                    <br><br>

                    <i class="fa fa-envelope icon"></i>
                    <input type="text" id="email" name="email" size="30" placeholder="Bitte geben Sie Ihre E-Mail ein" required>
                    <br><br>

                    <i class="fas fa-language icon"></i>
                    <select name="sprache" id="sprache" size="1">
                        <option value="English">English</option>
                        <option value="Deutsch" selected>Deutsch</option>
                        <option value="Denglisch">Denglisch</option>
                    </select>
                    <br><br>

                    <i class="fas fa-lock icon" id="copyright"></i>
                    <input title="Zustimmung zum Datenschutz" type="checkbox" id="Datenschutz" name="Datenschutz" required>
                    <br>

                    <input name="submit" id="submit" type="submit" value="Zum Newsletter anmelden" ><br><br>
                </fieldset>
            </form>
            <p><?php if($fehler) echo $fehler;
                else if (is_bool($fehler))echo 'Erfolgreich zum Newsletter angemeldet!'
                ?></p>

        </section>
        <!--Wichtig----------------------------------------------------->
        <section id="wichtig">
                <h5>Das ist uns Wichtig</h5>
                <ul>
                    <li> <i class="fas fa-angle-right"></i>Beste frische Saisonale Zutaten</li>
                    <li> <i class="fas fa-angle-right"></i>Ausgewogene abwechslungreiche Gerichte</li>
                    <li> <i class="fas fa-angle-right"></i>Sauberkeit</li>
                </ul>
        </section>

        <p>Wir freuen uns auf Ihren Besuch!</p>
    </main>
    <hr>
    <!--Footer----------------------------------------------------->
    <footer>
        <ul>
            <li>(c) E-Mensa GmbH</li>
            <li>Fabian Kirchhoff & Glenn Verhaag</li>
            <li>Impressum</li>
        </ul>
    </footer>
</body>
</html>