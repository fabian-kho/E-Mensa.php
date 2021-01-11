<?php

//Admin-Passwort: ichbineinadmin  Admin-Email:admin@emensa.example

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoginController
{
    public function check(RequestData $rd)
    {
        $pdo = connectdb_PDO();

        /** Nutzereingabe in Variablen speichern, Salt zum Passwort hinzufügen und hashen */
        $email = $rd->query['email'] ?? false;
        $password = sha1("emensa2020" . $rd->query['password']) ?? false;


        /** Datenbank Abfrage der Nutzerdaten per Prepared Statement */
        $link = connectdb();
        $statement = $link->prepare("SELECT count(1) FROM benutzer WHERE email = ? AND passwort= ?");
        $statement->bind_param('ss', $email, $password);
        $statement->execute();
        $statement->bind_result($found);
        $statement->fetch();


        /** Weiterleitung abhängig vom Erfolg der Anmeldung */
        $_SESSION['login_result_message'] = null;
        $log=logger();
        if ($found) {

            //Anmeldungzähler aktualisieren
            $stmt = $pdo->prepare("CALL anmeldungsZaehler(?)");
            $stmt->bindParam(1, $email, PDO::PARAM_STR, 4000);
            $stmt->execute();

            //Letzte Anmeldung aktualisieren
            $stmt = $pdo->prepare("CALL letzteAnmeldung(?)");
            $stmt->bindParam(1, $email, PDO::PARAM_STR, 4000);
            $stmt->execute();

            $_SESSION['login_ok'] = true;
            $_SESSION["name"] = $email;
            $log->info('Anmeldung', ['email'=>$email]);
            header('Location: /werbeseite');
        } else {

            //Letzter Fehler aktualisieren
            $stmt = $pdo->prepare("CALL letzterFehler(?)");
            $stmt->bindParam(1, $email, PDO::PARAM_STR, 4000);
            $stmt->execute();


            $_SESSION['login_result_message'] =
                'Email- oder Passwort falsch';
            //header('Location: /anmeldung');
            $log->warning('Versuchte Anmeldung',['email'=>$email]);
            header('Location: /anmeldung');

        }
        mysqli_close($link);
    }

    public function index(RequestData $rd)
    {
        $msg = $_SESSION['login_result_message'] ?? null;
        return view('login.anmeldung', ['msg' => $msg]);
    }

    public function logout(RequestData $rd)
    {
        $_SESSION['login_ok'] = false;

        $log=logger();
        $log->info('Abmeldung', ['email'=>$_SESSION["name"]]);
        header('Location: /werbeseite');
    }
}