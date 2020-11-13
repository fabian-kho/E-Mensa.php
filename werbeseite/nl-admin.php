<?php
/**
 * Praktikum DBWT. Autoren:
 * Fabian, Kirchhoff, 3191755
 * Glenn, Verhaag, Matrikelnummer2
 */


const GET_PARAM_SEARCH_TEXT = 'search_text';

//Array aus Datei auslesen
$tmp=file('./data.txt');
$anmeldungen = array();
foreach ($tmp as $line){
    array_push($anmeldungen,unserialize($line));
}

//Sortiert ein Array anhand einer gewünschten Spalte
function aasort (&$array, $key) {
    $sorter=array();    //definieren als array
    $ret=array();
    reset($array);  //Pointer auf erstes Element setzen
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key]; //Speichere nur die gewünschte Spalte in sorter ab
    }
    asort($sorter);       //Sortiere diese Spalte
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];  //Speichere das array in der richtigen reihenfolge ab
    }
    $array=$ret;
}

//Sortiere nach Name oder E-Mail
if(!empty($_GET['sortN'])) aasort($anmeldungen, 'name');
if(!empty($_GET['sortE'])) aasort($anmeldungen,'email');


//Filterung nach Name
$showUser = [];
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($anmeldungen as $rating) {
        if (stristr($rating['name'], $searchTerm) !== false) { //stristr berücksichtigt keine Groß-Kleinschreibung
            $showUser[] = $rating;
        }
    }
}else {
    $showUser = $anmeldungen;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="css/style_css.css">
    <title> Newsletter Anmeldungen</title>
</head>
<body>
<form method="get" >
<table id="sptable" >
    <tr id="zeile1">
        <th>Name
            <label style="float:  right">Sortiere
                <input title="Sortieren" type="checkbox" id="sortN" name="sortN">
        </th>
        <th>E-Mail
            <label style="float:  right">Sortiere
                <input title="Sortieren" type="checkbox" id="sortE" name="sortE">
        </th>
        <th>Sprache</th>
        <th>Datenschutz</th>
    </tr>
    <?php

    //Gebe Tabelle aus
    foreach ($showUser as $a => $arrays){
        foreach ($arrays as $type => $content){
            switch ($type){
                case "name":
                    echo "<tr><td>{$content}</td>";
                    break;
                case "sprache":
                case "email":
                    echo "<td>{$content}</td>";
                    break;
                case "datenschutz":
                    echo   "<td>{$content}</td></tr>";
                default:

            }
        }
    }
    ?>
</table>
    <input id="apply1" type="submit" value="sort" >

    <form method="get">
        <label for="search_text">Filter: </label>
        <input id="search_text" type="text" name="search_text" value=<?php echo $searchTerm?>>
        <input type="submit" value=suchen>
    </form>

</form>