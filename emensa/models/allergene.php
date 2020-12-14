<?php

/** Füge die Gerichte (inklusive der Allergene) in die Tabelle ein **********************************/
function db_allergene_select_all_new()
{
    $link = connectdb();

    $sql = "SELECT DISTINCT gha.code as Code, a.name as Allergen FROM gericht_hat_allergen gha
            LEFT JOIN allergen a on a.code = gha.code";

    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_close($link);
    return $data;
}
