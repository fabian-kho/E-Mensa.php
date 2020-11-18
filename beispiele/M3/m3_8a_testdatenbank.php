<?php
/**
 * Praktikum DBWT. Autoren:
 * Fabian, Kirchhoff, 3191755
 * Glenn, Verhaag, 3173673
 */

$link = mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "root123",    // Passwort
    "e_mensa"    // Auswahl der Datenbanken (bzw. des Schemas)
// optional port der Datenbank
);

if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

$sql = "SELECT  name, beschreibung FROM gericht ORDER BY name DESC LIMIT 5"; //Die Ersten 5 Gerichte mit Beschreibung auswählen

$result = mysqli_query($link, $sql);
if (!$result) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}
echo '<table>';
echo '<tr>', '<th>', "Gericht", '</th>', '<th>', "Beschreibung", '</th>', '</tr>'; //Erste Zeile der Tabelle
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>', '<th>', $row['name'], '</th>', '<th>', $row['beschreibung'], '</th>', '</tr>'; //Die Gerichte mit Beschreibung ausgeben
}
echo '</table>';

mysqli_free_result($result);
mysqli_close($link);
