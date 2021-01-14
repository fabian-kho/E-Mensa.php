<?php
/**
 * Diese Datei regelt die Anmeldung zum Newsletter
 */

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

/*function db_gerichtBilder_select_Rating() {

    $pdo=connectdb_PDO();

    //Id des Gerichtes herausfinden
    $stmt = $pdo->prepare("Select id From gericht where name = ?");
    $stmt->execute([$_POST['gerichtName']]);
    $gerichtid = $stmt->fetch();

    //Bild des aktuellen Gerichtes herausfinden
    $stmt = $pdo->prepare("SELECT bildname,name FROM gericht WHERE id=?");
    $stmt->execute([$gerichtid]);
    $gerichtbild = $stmt->fetch();

    return $gerichtbild['bildname'];
}
*/
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


                $fehler='stored';


            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
    $pdo = null;

    return $fehler;

}


