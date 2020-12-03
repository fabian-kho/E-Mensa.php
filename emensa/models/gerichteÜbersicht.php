<?php
/** Füge die Gerichte (inklusive der Allergene) in die Tabelle ein **********************************/
function db_gericht_select_all_new()
{
    $link = connectdb();

    $sql = "SELECT name, GROUP_CONCAT(code) as code  ,preis_intern, preis_extern FROM gericht
                    LEFT JOIN gericht_hat_allergen gha on gericht.id = gha.gericht_id
                    GROUP BY name
                    ORDER BY name ASC ";

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
