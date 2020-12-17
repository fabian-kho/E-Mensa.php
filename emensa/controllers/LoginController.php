<?php

//Admin-Passwort: ichbineinadmin  Admin-Email:admin@emensa.example
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
        if ($found) {

            try {
                $stmt = $pdo->prepare("CALL anmeldungsZaehler(?)");
                $stmt->bindParam(1, $email, PDO::PARAM_STR, 4000);
                $stmt->execute();
                //pdo übergeben
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            $_SESSION['login_ok'] = true;
            $_SESSION["name"] = $email;
            header('Location: /werbeseite');
        } else {
            $_SESSION['login_result_message'] =
                'Email- oder Passwort falsch';
            //header('Location: /anmeldung');
        }
        mysqli_close($link);
    }

    public function index(RequestData $rd)
    {
        $msg = $_SESSION['login_result_message'] ?? null;
        return view('login.anmeldung', ['msg' => $msg]);
    }

    public function logout()
    {
        $_SESSION['login_ok'] = false;
        header('Location: /werbeseite');
    }
}