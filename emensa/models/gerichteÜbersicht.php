<?php
/** Füge die Gerichte (inklusive der Allergene) in die Tabelle ein **********************************/
function db_gericht_select_all_new()
{
    $link = connectdb();

    $sql = "SELECT name, GROUP_CONCAT(code) as code  ,preis_intern, preis_extern FROM gericht
                    LEFT JOIN gericht_hat_allergen gha on gericht.id = gha.gericht_id
                    GROUP BY name
                    ORDER BY name
                    LIMIT 5";

    $result = mysqli_query($link, $sql);

    mysqli_close($link);
    return $result;
}
