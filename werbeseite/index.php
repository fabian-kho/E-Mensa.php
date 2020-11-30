<?php
/**
 * Praktikum DBWT. Autoren:
 * Fabian, Kirchhoff, 3191755
 * Glenn, Verhaag, 3173673
 */

/**
 * TO_DO
 * Fabian: Aufgaben -> 1,7 / 6 c,d
 * Glenn: Aufgaben -> 2,8 / 6 a,b
 */


/****SQL*************************/
include "connection_example.php";

$link = mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "",       // Passwort
    "e_mensa"           // Auswahl der Datenbanken (bzw. des Schemas)
// optional port der Datenbank
);

//Counter für Gerichte
$sql_tmp = "SELECT count(name) as anzahl FROM gericht";
$Anzahl_gerichte = mysqli_fetch_assoc(mysqli_query($link, $sql_tmp));

/****Newsletter*************************/

$blacklist = [1 => 'rcpt.at',
    2 => 'damnthespam.at',
    3 => 'wegwerfmail.de',
    4 => 'trashmail.de',
    5 => 'trashmail.com'];

function find_text_in_array(array $array, $text): bool
{
    foreach ($array as $key => &$value) {
        if (strpos($text, $value) !== false) {
            return true;
        }
    }
    return false;
}

$fehler = false;
if (isset($_POST['submit'])) {

    $newsletter = [
        'name' => trim($_POST['name'] ?? NULL), //gesetzt?
        'email' => trim($_POST['email'] ?? NULL),
        'sprache' => trim($_POST['sprache'] ?? NULL),
        'datenschutz' => $_POST['Datenschutz'] ?? NULL
    ];

    //Benutzereingabe in HTML Code umwandeln um XSS zu verhindern
    $newsletter['name']=htmlspecialchars($newsletter['name']);
    $newsletter['email']=htmlspecialchars($newsletter['email']);

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

    //E-mail auf zulässigkeit prüfen
    if (find_text_in_array($blacklist, $newsletter['email'])) {
        $fehler = 'Diese E-Mail ist nicht zulässig.';
    }

    //Store
    if (!$fehler) {
        $Userdata = file_put_contents('./Newsletter/NL_Anmeldungen.txt', serialize($newsletter) . "\r\n", FILE_APPEND);
        $fehler='stored';
    }
}

/****Zähler*************************/

//Persistenten Zähler für die Anzahl der Besucher
$dateiname = "besucher.txt";
$counter = fopen($dateiname, "r");
$aufrufe = fread($counter, filesize($dateiname)); //alten counter einlesen
fclose($counter);

$aufrufe = $aufrufe + 1; //counter um 1 erhöhen

$counter = fopen("besucher.txt", "w");
fwrite($counter, $aufrufe); //neuen counter speichern
fclose($counter);


//Zähler für Anzahl der Anmeldungen zum Newsletter
$anmeldungen = 0;
$file = "./Newsletter/NL_Anmeldungen.txt";
$handle = fopen($file, "r");
while (!feof($handle)) {
    $line = fgets($handle);
    if (!empty($line)) $anmeldungen++;   //Wenn datei nicht leer, dann zähle hoch
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
<img id="Logo_neu" src="image/EMensa_Logo_neu.png" alt="Logo" width="300" height="175">
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
        <p id="textfeld">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
            ut labore et dolore magna aliquyam erat,
            sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no
            sea takimata sanctus est Lorem ipsum dolor
            sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
            labore et dolore magna aliquyam erat,
            sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no
            sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
    </section>
    <!--Tabelle----------------------------------------------------------------------------->
    <section id="speisen">
        <h2>Köstlichkeiten, die Sie erwarten</h2>
        <table id="gerichtTabelle">
            <tr id="zeile1">
                <th></th>
                <th>Preis intern</th>
                <th>Preis extern</th>
            </tr>
            <?php

            /** Füge die Gerichte (inklusive der Allergene) in die Tabelle ein **********************************/
            $sql = "SELECT name, GROUP_CONCAT(code) as code  ,preis_intern, preis_extern FROM gericht
                    LEFT JOIN gericht_hat_allergen gha on gericht.id = gha.gericht_id
                    GROUP BY name
                    ORDER BY name ASC
                    LIMIT 5";

            $result = mysqli_query($link, $sql);

            //Trage Zeile für Zeile $row in die Tabelle ein
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";

                echo "<td>{$row['name']}<span style='font-size: medium; float: right'>{$row['code']}</span></td>";

                //Geld Format & tausche . gegen ,
                $number = str_replace('.', ',', sprintf('%01.2f', $row['preis_intern']));
                echo "<td>{$number}</td>";

                //Geld Format & tausche . gegen ,
                $number = str_replace('.', ',', sprintf('%01.2f', $row['preis_extern']));
                echo "<td>{$number}</td>";

                echo "</tr>";
            }
            //Letzte Zeile ausgeben
            echo "<tr>";
            echo "<td> . . . </td>";
            echo "<td> ... </td>";
            echo "<td> ... </td>";
            echo "</tr>";

            mysqli_free_result($result); ?>
        </table>
    </section>
    <!--Allergene-------------------------------------------------------------------------------------->
    <section id="Allergene">
        <i class="fas fa-allergies icon" id="lock"></i>
        <input title="Allergene anzeigen" type="checkbox" id="AllergenButton" name="AllergenButton" required>
        <?php
        /** Füge alle verwendeten Allerge in eine Liste ein**********************************************/

        $sql = "SELECT DISTINCT gha.code as Code, a.name as Allergen FROM gericht_hat_allergen gha
                            LEFT JOIN allergen a on a.code = gha.code";

        $result = mysqli_query($link, $sql);

        echo '<ul id="AllergenListe" class="AllergenListe">';
        while ($row = mysqli_fetch_assoc($result)) {        //Trage Zeile für Zeile $row in Liste ein
            echo '<li><i class="fas fa-angle-right"></i>';
            echo $row['Allergen'];
            echo '  (' . $row['Code'], '</li>';
        }
        echo '</ul>';


        mysqli_free_result($result);
        mysqli_close($link);
        ?></section>
    <!--Zahlen----------------------------------------------------->
    <section id="zahlen">
        <h3>E-Mensa in Zahlen</h3>
        <div id="zahl1"><p><?php echo $aufrufe ?></p>
            <p>Besuche</p></div>
        <div id="zahl2"><p><?php echo $anmeldungen ?></p>
            <p>Anmeldungen zum Newsletter</p></div>
        <div id="zahl3"><p><?php echo $Anzahl_gerichte['anzahl'] ?></p>
            <p>Speisen</p></div>

    </section>
    <!--Newsletter----------------------------------------------------->
    <section id="kontakt">
        <h4>Interesse geweckt? Wir informieren Sie!</h4>
        <form method="post">
            <fieldset>

                <i class="fa fa-user icon"></i>
                <label for="name"></label><input type="text" id="name" name="name" size="30"
                                                 placeholder="Bitte geben Sie Ihren Namen ein"
                                                 required>
                <br><br>

                <i class="fa fa-envelope icon"></i>
                <label for="email"></label><input type="text" id="email" name="email" size="30"
                                                  placeholder="Bitte geben Sie Ihre E-Mail ein"
                                                  required>
                <br><br>

                <i class="fas fa-language icon"></i>
                <label for="sprache"></label><select name="sprache" id="sprache" size="1">
                    <option value="English">English</option>
                    <option value="Deutsch" selected>Deutsch</option>
                    <option value="Denglisch">Denglisch</option>
                </select>
                <br><br>

                <i class="fas fa-lock icon" id="lock"></i>
                <input title="Zustimmung zum Datenschutz" type="checkbox" id="Datenschutz" name="Datenschutz" required>
                <br>

                <input name="submit" id="submit" type="submit" value="Zum Newsletter anmelden"><br><br>
            </fieldset>
        </form>
        <p><?php if (!empty($fehler) && $fehler!= 'stored') echo $fehler;
            else if ($fehler === 'stored') echo 'Erfolgreich zum Newsletter angemeldet!'
            ?></p>

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