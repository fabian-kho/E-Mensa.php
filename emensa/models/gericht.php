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

function db_gericht_select_all_name() {
    $link = connectdb();

    $sql = "SELECT id, name FROM gericht ORDER BY name asc ";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);
    return $data;
}

function db_gerichtBilder_select_all() {
    $link = connectdb();

    $sql = "SELECT bildname,name FROM gericht ";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);

    return $data;
}

function db_gericht_select_all_and_allergen()
{
    $link = connectdb();

    $sql = "SELECT name, GROUP_CONCAT(code) as code  ,preis_intern, preis_extern FROM gericht
                    LEFT JOIN gericht_hat_allergen gha on gericht.id = gha.gericht_id
                    GROUP BY name
                    ORDER BY name ASC";

    $result = mysqli_query($link, $sql);
    $i=0;
    while($row = mysqli_fetch_assoc($result)) {
        $row['preis_intern']= number_format($row['preis_intern'], 2, ',', '.');
        $row['preis_extern']= number_format($row['preis_extern'], 2, ',', '.');

        $data[$i]=$row;
        $i++;
    }
    mysqli_close($link);
    return $data;
}
