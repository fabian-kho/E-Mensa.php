<?php
include "m2_4a_standardparameter.php";
/**
 * Praktikum DBWT. Autoren:
 * Fabian, Kirchhoff, 3191755
 * Vorname2, Nachname2, Matrikelnummer2
 */
const GET_PARAM_ADD = 'add';
const GET_PARAM_MULT = 'mult';
const GET_PARAM_A = 'parA';
const GET_PARAM_B = 'parB';


function multNumbers(int $a, int $b) {
    $result=$a * $b;
    return $result;
}

if(!empty($_GET[GET_PARAM_ADD])){
    $a=$_GET[GET_PARAM_A];
    $b=$_GET[GET_PARAM_B];
    $result=addNumbers($a,$b);
}

if(!empty($_GET[GET_PARAM_MULT])){
    $a=$_GET[GET_PARAM_A];
    $b=$_GET[GET_PARAM_B];
    $result=multNumbers($a,$b);
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title> Addition und Multiplikation</title>
</head>
<body>
    <form method="get">
        <label for="parA">Zahl 1:</label><br>
        <input type="text" id="parA" name="parA" value="0"><br>
        <label for="parB">Zahl 2:</label><br>
        <input type="text" id="parB" name="parB" value="0"><br><br>
        <label for="add">Addieren:</label>
        <input id="add" type="checkbox" name="add">
        <label for="mult">Multiplizieren:</label>
        <input id="mult" type="checkbox" name="mult">
        <input type="submit" value="Los!" id="apply">
    </form>
    <p>Ergebnis:<?php echo $result ?></p>
</body>
