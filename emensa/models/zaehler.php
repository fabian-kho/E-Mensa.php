<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "kategorie"
 */
function zaehlerBesucher()
{
    //Persistenten Zähler für die Anzahl der Besucher
    $dateiname = "db/besucher.txt";
    $counter = fopen($dateiname, "r");
    $aufrufe = fread($counter, filesize($dateiname)); //alten counter einlesen
    fclose($counter);

    $aufrufe = $aufrufe + 1; //counter um 1 erhöhen

    $counter = fopen("db/besucher.txt", "w");
    fwrite($counter, $aufrufe); //neuen counter speichern
    fclose($counter);

    return $aufrufe;
}
function zaehlerAnmeldungen()
{
//Zähler für Anzahl der Anmeldungen zum Newsletter
    $anmeldungen = 0;
    $file = "db/NL_Anmeldungen.txt";
    $handle = fopen($file, "r");
    while (!feof($handle)) {
        $line = fgets($handle);
        if (!empty($line)) $anmeldungen++;   //Wenn datei nicht leer, dann zähle hoch
    }
    fclose($handle);

    return $anmeldungen;
}

function zaehlerGerichte(){
    $link = connectdb();
    //Counter für Gerichte
    $sql_tmp = "SELECT count(name) as anzahl FROM gericht";

    $anzahl_gerichte = mysqli_fetch_assoc(mysqli_query($link, $sql_tmp));

    return $anzahl_gerichte;
}

