<?php
/**
 * Praktikum DBWT. Autoren:
 * Fabian, Kirchhoff, 3191755
 * Vorname2, Nachname2, Matrikelnummer2
 */

$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019]
];

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title> Gerichte</title>
</head>
<body>

<ul style="list-style: none;"><?php $i=0;  //Schleifen index
foreach($famousMeals AS $Key => $array) {   //Durchläuft Array $famousMeals
    "<li>";
    echo "<br>", $Key, ".";               //Gibt Key aus

    foreach ($array as $name => $meal) { //Durchläuft Array der Keys
        if (is_array($meal)) {            //Wenn Inhalt nochmal ein Array ist dann gebe Jahre aus
            echo "    ";

            foreach ($meal as $year) {
                echo $year;
                $winner[$i++]=$year;                        //Schreibe das Jahr ins Array
                if (end($meal) != $year) echo ", ";  //Wenn Ende des arrays (year) nicht erreicht gebe komma aus
                else "</li>";                              //Listeneintrag schließen
            }

            echo "<br>";
        } //Gebe Gericht aus
        else echo "    $meal <br>&nbsp;&nbsp;&nbsp"; //Leerzeichen einfügen
    }
}
?></ul>

<p>Im diesen Jahren, von 2000 bis 2020, gab es keinen Gewinner:
    <?php $counter=0;
        for($i=2000;$i<=2020;$i++){
            if(!in_array($i,$winner,false)) {
                if($counter++ !== 0) echo ", ";     //Wenn es nicht das erste Element ist gebe Komma aus
                echo $i;                            //Wenn Jahr(i) nicht vorhanden gebe es aus
            }
        }

    ?> </p>
</body>
