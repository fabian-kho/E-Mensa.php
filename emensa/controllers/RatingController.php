<?php
require_once('../models/GerichtA.php');
require_once('../models/BewertungA.php');
require_once('../models/bewerten.php');
require_once('../models/delete.php');
require_once('../models/gericht.php');
use \Illuminate\Database\Capsule\Manager as DB;

class RatingController
{
    public function bewertung()
    {
        //Nur angemeldete Benutzer können Gerichte bewerten
        if($_SESSION['login_ok'] == true) {

            $data = $_GET['gerichtbewerten'];

            $Bewertung=GerichtA::query()
                ->where('name', $data);
            echo $Bewertung->beschreibung;
/*
             $vars = [
                  'fehler_WG' => $fehler_WG = bewertung_eintragen(),
                  'array' => $array = gericht_bewerten($data),
              ];

              return view('bewertung.bewertung', $vars);
          }
          else{
              $msg = $_SESSION['login_result_message'] ?? null;
              return view('login.anmeldung', ['msg' => $msg]);
*/
        }
    }

    public function bewertungen()
    {
        //Nur angemeldete Benutzer können Gerichte bewerten
        if($_SESSION['login_ok'] == true) {



            $vars = [
                'bewertung' => $bewertung = db_all_ratings(),
                'anzahlbewertungen' => $anzahlbewertungen = zaehlerBewertungen(),
                'color' => $color = bewertung_highlight(),
                'admin' => $admin = is_admin()
            ];

            return view('bewertung.bewertungenListe', $vars);
        }
        else{
            $msg = $_SESSION['login_result_message'] ?? null;
            return view('login.anmeldung', ['msg' => $msg]);
        }
    }
    public function meinebewertungen()
    {
        //Nur angemeldete Benutzer können Gerichte bewerten
        if($_SESSION['login_ok'] == true) {

            $vars = [
                'mybewertung' => $mybewertung = db_user_ratings(),
                'anzahl_user_bewertungen' => $anzahl_user_bewertungen = zaehler_user_Bewertungen(),
                'fehler'=> $fehler = bewertung_delete()

            ];

            return view('bewertung.meinebewertungen', $vars);
        }
        else{
            $msg = $_SESSION['login_result_message'] ?? null;
            return view('login.anmeldung', ['msg' => $msg]);
        }
    }

    public function get() {

    }
}