<?php
require_once('../models/GerichtA.php');
require_once('../models/BewertungA.php');
require_once('../models/bewerten.php');
require_once('../models/gericht.php');
require_once('../models/zaehler.php');
use \Illuminate\Database\Capsule\Manager as DB;

class RatingController
{
    public function bewertung()
    {
        //Nur angemeldete Benutzer können Gerichte bewerten
        if($_SESSION['login_ok'] == true) {

            $test= GerichtA::query()
                ->where('name', 'Pilzpfanne')
                ->first();
            //var_dump($test);
            $test->vegetarisch="nein";
            $test->save();
            echo $test->vegetarisch;

            $data = $_GET['gerichtbewerten'];

             /*$vars = [
                  'fehler_WG' => $fehler_WG = bewertung_eintragen(),
                  'array' => $array = GerichtA::gericht_bewerten($data),
              ];
            */
            $result=GerichtA::gericht_bewerten($data);

            $vars = [
                'fehler_WG' => $fehler_WG = bewertung_eintragen(),
                'array' => $array = $result,
            ];
             return view('bewertung.bewertung', $vars);
          }
          else{
              $msg = $_SESSION['login_result_message'] ?? null;
              return view('login.anmeldung', ['msg' => $msg]);

        }
    }

    public function bewertungen()
    {
        //Nur angemeldete Benutzer können Gerichte bewerten
        if($_SESSION['login_ok'] == true) {



            $vars = [
                'bewertung' => $bewertung = db_all_ratings(),
                'anzahlbewertungen' => $anzahlbewertungen = zaehlerBewertungen(),
                'color' => $color = BewertungA::bewertung_highlight(),
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
                'fehler'=> $fehler = BewertungA::bewertung_delete()

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