<?php /**
 * Praktikum DBWT. Autoren:
 * Fabian, Kirchhoff, 3191755
 * Glenn, Verhaag, 3173673
 */



/*****Wunschgericht zur Datenbank hinzufügen****************************/
/**
 * To-Do
 * -Max zecihen für eingabe festlegen
 * -ggf whitelist
 */
function wunschgericht_anmeldung()
{
    $pdo=connectdb_PDO();

    $fehler = false;
    if (isset($_POST['submit'])) {

        //Prüfen ob leer?
        if (empty($_POST['gerichtName'])) {
            $fehler = 'Der Gerichtname darf nicht leer sein. ';
        }
        //Prüfen ob leer?
        if (empty($_POST['beschreibung'])) {
            $fehler = 'Die Beschreibung darf nicht leer sein.';
        }

        //E-Mail validierung
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $fehler = 'Die E-Mail hat das falsche Format.    ';
            if (empty($wunschgericht['email'])) {
                $fehler = 'Die E-Mail darf nicht leer sein.      ';
            }
        }

        //Wenn keine Fehler aufgetreten sind, dann speichere Daten in Datenbank
        if (!$fehler) {
            try {

                $pdo->beginTransaction();

                // Füge in Tabelle wunschgerichte ein
                $pdo->prepare("INSERT INTO wunschgericht (name, beschreibung, erstellt_am)
            VALUES (?,?,current_date)")->execute([$_POST['gerichtName'], $_POST['beschreibung']]);

                //Checke ob email(Also benutzer) schon vorhanden
                $stmt = $pdo->prepare("SELECT count(email) as cnt FROM ersteller WHERE email = ?");
                $stmt->execute([$_POST['email']]);
                $check = $stmt->fetch();
                //Wenn Benutzer noch nicht vorhanden, erstelle einen
                if ($check['cnt'] == 0) {
                    $pdo->prepare("INSERT INTO ersteller (email, name) VALUES (?,?)")
                        ->execute([$_POST['email'], $_POST['name']]);
                }

                //Id des Gerichtes herausfinden
                $stmt = $pdo->prepare("Select id From wunschgericht where name = ?");
                $stmt->execute([$_POST['gerichtName']]);
                $array = $stmt->fetch();
                //In Tabelle ersteller_wunschgericht einfügen
                $pdo->prepare('INSERT INTO ersteller_wunschgericht (wunschgericht_id, ersteller_email) VALUES (?,?)')
                    ->execute([$array['id'], $_POST['email']]);

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
