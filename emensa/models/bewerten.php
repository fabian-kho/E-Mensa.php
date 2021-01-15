<?php

$GlobalgerichtId=0;

function gericht_bewerten()
{
    if (isset($_GET['bewertung'])) {

        $namen= $_GET['gerichtbewerten'];

        $pdo=connectdb_PDO();

        //Id des Gerichtes herausfinden
        $stmt = $pdo->prepare("Select id From gericht where name = ?");
        $stmt->execute([$namen]);
        $gerichtid = $stmt->fetch();

        //Bild des aktuellen Gerichtes herausfinden
        $stmt = $pdo->prepare("SELECT bildname FROM gericht WHERE id=?");
        $stmt->execute([$gerichtid['id']]);
        $gerichtbild = $stmt->fetch();

        $bild= $gerichtbild['bildname'];

        $vars = [
            'namen' => $namen,
            'bild' => $bild
        ];
    }
    return $vars;
}

function db_all_ratings() {

    $link = connectdb();

    $sql = "SELECT bewertung.id as ID ,bemerkung, sterne, erstellt_am AS date,email,name AS Gericht, highlight  FROM bewertung
            JOIN benutzer_bewertung bb on bewertung.id = bb.bewertungs_id
            LEFT JOIN benutzer b on b.id = bb.benutzer_id
            LEFT JOIN bewertung_gericht bg on bewertung.id = bg.bewertungs_id
            LEFT JOIN gericht g on g.id = bg.gericht_id  Order By erstellt_am DESC ";

    $result = mysqli_query($link, $sql);

    $i=0;
    while($row = mysqli_fetch_assoc($result)) {
        if($row['highlight']==1)
        $row['highlight']= 'green';
        else
            $row['highlight']= 'white';

        $data[$i]=$row;
        $i++;
    }

    //var_dump($data);

    mysqli_close($link);
    return $data;
}

function db_highlight_ratings() {

    $link = connectdb();

    $sql = "SELECT  bemerkung, sterne ,name AS Gericht FROM bewertung
            JOIN benutzer_bewertung bb on bewertung.id = bb.bewertungs_id
            LEFT JOIN benutzer b on b.id = bb.benutzer_id
            LEFT JOIN bewertung_gericht bg on bewertung.id = bg.bewertungs_id
            LEFT JOIN gericht g on g.id = bg.gericht_id
            WHERE highlight = true";

    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function db_user_ratings() {

    $pdo=connectdb_PDO();

    $sql = "SELECT  bewertung.id as ID,bemerkung, sterne, erstellt_am AS date,email,name AS Gericht FROM bewertung
            JOIN benutzer_bewertung bb on bewertung.id = bb.bewertungs_id
            LEFT JOIN benutzer b on b.id = bb.benutzer_id
            LEFT JOIN bewertung_gericht bg on bewertung.id = bg.bewertungs_id
            LEFT JOIN gericht g on g.id = bg.gericht_id
            WHERE email = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION["name"]]);
    $bewertungsid = $stmt->fetchAll();

    return $bewertungsid;

}


function bewertung_eintragen(){

    $pdo=connectdb_PDO();

    $fehler = false;
    if (isset($_POST['submit'])) {

        //Prüfen ob leer?
        if (empty($_POST['gerichtName'])) {
            $fehler = 'Der Gerichtname darf nicht leer sein. ';
        }
        //Prüfen ob leer?
        if (empty($_POST['bemerkung'])) {
            $fehler = 'Die Beschreibung darf nicht leer sein.';
        }
        //Prüfen ob leer?
        $bemerkung = ($_POST['bemerkung']);
        if (strlen($bemerkung) < 5) {
            $fehler = 'Die Bemerkung muss min. 5 Zeichen lang sein!';
        }



        //Wenn keine Fehler aufgetreten sind, dann speichere Daten in Datenbank
        if (!$fehler) {
            try {

                $pdo->beginTransaction();

                //In Tabelle bewertung einfügen
                $pdo->prepare('INSERT INTO bewertung (bemerkung,sterne,erstellt_am) 
                VALUES (?,?,current_timestamp)')->execute([$_POST['bemerkung'], $_POST['rating']]);


                //Id des Gerichtes herausfinden
                $stmt = $pdo->prepare("Select id From gericht where name = ?");
                $stmt->execute([$_POST['gerichtName']]);
                $gerichtid = $stmt->fetch();



                //Id der Bewertung herausfinden
                $stmt = $pdo->prepare("Select id From bewertung where bemerkung = ? && sterne = ? ");
                $stmt->execute([$_POST['bemerkung'],$_POST['rating']]);
                $bewertungsid = $stmt->fetch();

                //In Tabelle bewertung_gericht einfügen
                $pdo->prepare('INSERT INTO bewertung_gericht (gericht_id, bewertungs_id) VALUES (?,?)')
                    ->execute([$gerichtid['id'], $bewertungsid['id']]);


                //Id des Benutzers herausfinden
                $stmt = $pdo->prepare("Select id From benutzer where email = ?");
                $stmt->execute([$_SESSION["name"]]);
                $benutzerid = $stmt->fetch();

                //In Tabelle benutzer_bewertung einfügen
                $pdo->prepare('INSERT INTO benutzer_bewertung (benutzer_id, bewertungs_id) VALUES (?,?)')
                    ->execute([$benutzerid['id'], $bewertungsid['id']]);

                $pdo->commit();     //pdo übergeben


                $fehler='Bewertung abgegeben';

                header('Location: /werbeseite');

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    $pdo = null;

    return $fehler;

}

function is_admin()
{
    $pdo=connectdb_PDO();

    $sql = "SELECT  admin FROM bewertung
            JOIN benutzer_bewertung bb on bewertung.id = bb.bewertungs_id
            LEFT JOIN benutzer b on b.id = bb.benutzer_id
            WHERE email = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION["name"]]);
    $admin = $stmt->fetch();


    return $admin;
}
