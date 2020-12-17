<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
class LoginController
{
    public function check(RequestData $rd)
    {
        /** Nutzereingabe in Variablen speichern, Salt zum Passwort hinzufügen und hashen */
        $email = $rd->query['email'] ?? false;
        $password = sha1("emensa2020" . $rd->query['password']) ?? false; //Admin-Passwort: ichbineinadmin  Admin-Email:admin@emensa.example


        /** Datenbank Abfrage der Nutzerdaten per Prepared Statement */
        $link = connectdb();
        $statement = $link->prepare("SELECT count(1) FROM benutzer WHERE email = ? AND passwort= ?");
        $statement->bind_param('ss',$email,$password);
        $statement->execute();
        $statement->bind_result($found);
        $statement->fetch();


        /** Weiterleitung abhängig vom Erfolg der Anmeldung */
        $_SESSION['login_result_message'] = null;
        $log=logger();
        if ($found) {
            $_SESSION['login_ok'] = true;
            $_SESSION["name"] = $email;
            $log->info('Anmeldung', ['email'=>$email]);
            header('Location: /werbeseite');
        } else {
            $_SESSION['login_result_message'] =
                'Email- oder Passwort falsch';
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
        $email = $rd->query['email'] ?? false;
        $stream= new StreamHandler(__DIR__.'/storage/logs/my_app.log', Logger::DEBUG);
        $logger= new Logger('Informationen');
        $logger->pushHandler($stream);

        $logger->info('Abmeldung', ['email'=>$email]);
        header('Location: /werbeseite');
    }
}