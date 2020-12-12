<?php

class LoginController
{
 public function check(RequestData $rd)
 {
    $email = $rd->query['email'] ?? false;
    $password = $rd->query['password'] ?? false;


     $statement = $mysqli->prepare("(?,?)");
     $statement->bind_param($email,$password);

     $_SESSION['login_result_message'] = null;
     if () {
         $_SESSION['login_ok'] = true;
         header('Location: /werbeseite');
     } else {
         $_SESSION['login_result_message'] =
             'Benutzer- oder Passwort falsch';
         header('Location: /anmeldung');
     }
 }

 public function index(RequestData $rd)
 {
     $msg = $_SESSION['login_result_message'] ?? null;
     return view('login.anmeldung', ['msg' => $msg]);
 }
 public function ende()
{
    session_destroy();
}
}
