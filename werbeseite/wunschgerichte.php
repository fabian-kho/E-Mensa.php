<?php /**
 * Praktikum DBWT. Autoren:
 * Fabian, Kirchhoff, 3191755
 * Glenn, Verhaag, 3173673
 */


/***PDO-Connection**************************/
$host = 'localhost';
$db = 'e_mensa';
$user = 'root';
$pass = 'Leonie3009';
$port = "3306";
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

/*****Wunschgericht zur Datenbank hinzufügen****************************/
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
            $vorhanden=$check['cnt'];
            //Wenn Benutzer noch nicht vorhanden, erstelle einen
            if ($vorhanden==0) {
                $pdo->prepare("INSERT INTO ersteller (email, name) VALUES (?,?)")
                    ->execute([$_POST['email'], $_POST['name']]);
            }

            //Id des Gerichtes herausfinden
            $stmt = $pdo->prepare("Select id From wunschgericht where name = ?");
            $stmt->execute([$_POST['gerichtName']]);
            $array = $stmt->fetch();
            $id = $array['id'];
            //In Tabelle ersteller_wunschgericht einfügen
            $pdo->prepare('INSERT INTO ersteller_wunschgericht (wunschgericht_id, ersteller_email) VALUES (?,?)')
                ->execute([$id, $_POST['email']]);

            $pdo->commit();     //pdo übergeben
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
$pdo = null;
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Wunschgerichte</title>
    <link rel="stylesheet" type="text/css" href="css/wunschgerichte_style.css">
</head>
<body>
<h1>Wunschgericht</h1>
<form method="post">
    <label>
        <input name="name" type="text" class="feedback-input" placeholder="Name"/>
    </label>
    <label>
        <input name="email" type="text" class="feedback-input" placeholder="Email"/>
    </label>
    <label>
        <input name="gerichtName" type="text" class="feedback-input" placeholder="Name des Gerichtes"/>
    </label>
    <label>
        <textarea name="beschreibung" class="feedback-input" placeholder="Beschreibung des Gerichtes"></textarea>
    </label>
    <input name="submit" id="submit" type="submit" value="Wunsch abschicken"/>
</form>
<p id="fehlermeldung"><?php if ($fehler) echo $fehler;
    else if (!empty($fehler)) echo 'Wunschgericht wurde hinzugefügt!'
    ?></p>
<hr>
<footer>
    <ul>
        <li>(c) E-Mensa GmbH</li>
        <li>Fabian Kirchhoff & Glenn Verhaag</li>
        <li>Impressum</li>
    </ul>
</footer>
</body>
