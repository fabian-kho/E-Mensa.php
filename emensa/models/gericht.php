<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */
function db_gericht_select_all() {
    $link = connectdb();

    $sql = "SELECT id, name, beschreibung,preis_intern FROM gericht WHERE preis_intern>2 ORDER BY name DESC ";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);
    return $data;
}
