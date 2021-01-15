<?php
/**
 * Diese Datei zählt alle Besucher, Anmeldungen und Gerichte
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

function zaehlerBewertungen(){
    $link = connectdb();
    //Counter für Gerichte
    $sql_tmp = "SELECT count(id) as anzahl FROM bewertung";

    $anzahl_gerichte = mysqli_fetch_assoc(mysqli_query($link, $sql_tmp));

    return $anzahl_gerichte;
}

function zaehler_user_Bewertungen(){


    $pdo=connectdb_PDO();

    $sql = "SELECT count(email) as anzahl FROM bewertung 
            JOIN benutzer_bewertung bb on bewertung.id = bb.bewertungs_id
            LEFT JOIN benutzer b on b.id = bb.benutzer_id
            WHERE email = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION["name"]]);
    $bewertungsid = $stmt->fetch();


    return $bewertungsid;

}
function zaehler_highlight_Bewertungen(){


    $link = connectdb();

    $sql = "SELECT count(highlight) as anzahl FROM bewertung 
            WHERE highlight = true";

    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    mysqli_close($link);

    return $row;

}

