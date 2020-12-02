
Shahane, [29.11.20 19:49]
<!DOCTYPE html>
<!--
- Praktikum DBWT. Autoren:
- Shahane, Zurabyan, 3250315
- Maria, Herbers, 3248177
-->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Dein Wunschgericht</title>
</head>
<body>
<p>Wenn Sie Vorschläge für Ihre Wunschgerichte haben, geben Sie diese hier gerne an! :-)</p>
<form method="post" action="/werbeseite/wunschgericht.php">
    <fieldset>
    <label for="gerichtname">Name des Gerichts:</label><br>
    <input type="text" id="gerichtname" name="gerichtname"><br>
    <label for="beschreibung">Beschreibung/Zubereitung</label><br>
    <input type="text" id="beschreibung" name="beschreibung"><br>
    <label for="datum">heutiges Datum: </label><br>
    <input type="text"  id="datum" name="datum" value="<?php echo date('d / m / Y'); ?>" readonly/><br>
    <label for="erstellername">Ihr Name:</label><br>
    <input type="text" id="erstellername" name="erstellername"><br>
    <label for="email">Ihre E-Mail Adresse:</label><br>
    <input type="email" id="email" name="email"><br><br>
    <input type="submit" id="sendgericht" name="sendgericht" value="Wunsch abschicken">
    </fieldset>
</form>
</body>
</html>
<?php
$link=mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "1477",    // Passwort
    "emensawerbeseite"      // Auswahl der Datenbanken (bzw. des Schemas)
// optional port der Datenbank
//);


if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

if(isset($_POST['submit']))
{
    $gerichtname = $_POST['gerichtname'];
    $beschreibung = $_POST['beschreibung'];
    $datum = $_POST['datum'];
    $erstellername = $_POST['erstellername'];
    $email = $_POST['email'];

    $sql1 = "INSERT INTO wunschgericht (name, beschreibung, erstellungsdatum)
     VALUES ('$gerichtname','$beschreibung','$datum')";
    // $sql2 = "INSERT INTO ersteller (name, email)
    //VALUES ('$erstellername','$email'";

    //mysqli_free_result($gerichtname, $beschreibung, $datum, $erstellername, $email);
    if (mysqli_query($link, $sql1)) {
        echo "New record has been added successfully !";
    } else {
        echo "Error: " . $sql1 . ":-" . mysqli_error($link);
    }

    mysqli_close($link);
}
?>