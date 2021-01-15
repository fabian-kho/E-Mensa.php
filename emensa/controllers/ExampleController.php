<?php
require_once('../models/kategorie.php');
require_once('../models/gericht.php');
require_once('../models/allergene.php');
require_once('../models/zaehler.php');
require_once('../models/newsletter.php');
require_once('../models/wunschgerichte.php');
require_once('../models/bewerten.php');
require_once('../models/delete.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
class ExampleController
{
    public function m4_6a_queryparameter(RequestData $rd)
    {
        $vars = [
            'name' => $rd->query['name'] ?? 'name',
            'rd' => $rd
        ];
        return view('examples.m4_6a_queryparameter', $vars);
    }

    public function m4_6b_kategorie()
    {
        $data = db_kategorie_select_all();
        return view('examples.m4_6b_kategorie', ['data' => $data]);
    }

    public function m4_6c_gerichte()
    {
        $data = db_gericht_select_all();
        return view('examples.m4_6c_gerichte', ['data' => $data]);
    }

    public function m4_6d_layout(RequestData $rd)
    {
        $vars = [
            'no' => $rd->query['no'] ?? '1',
            'rd' => $rd
        ];
        if ($vars['no'] == '2')
            return $this->m4_6d_page_2();
        else if ($vars['no'] == '1')
            return $this->m4_6d_page_1();

        return $this->m4_6d_page_1();
    }

    public function m4_6d_page_2()
    {
        $vars = [
            'data' => $data = db_kategorie_select_all(),
            'title' => $title = 'Page 2'
        ];
        return view('examples.pages.m4_6d_page_2', $vars);
    }

    public function m4_6d_page_1()
    {
        $vars = [
            'data' => $data = db_gericht_select_all(),
            'title' => $title = 'Page 1'
        ];
        return view('examples.pages.m4_6d_page_1', $vars);
    }

    public function werbeseite()
    {
       $log=logger();
       $log->info('Dies ist ein Seitenaufruf');

        $vars = [
            'gerichte' => $gerichte = db_gericht_select_all_and_allergen(),
            'gerichtnamen' => $gerichtnamen =  db_gericht_select_all_name(),
            'allergene' => $allergene = db_allergene_select_all_new(),
            'besucher' => $besucher = zaehlerBesucher(),
            'anmeldungen' => $anmeldungen = zaehlerAnmeldungen(),
            'anzahlGerichte' => $anzahlGerichte = zaehlerGerichte(),
            'fehler' => $fehler = newsletter_anmeldung(),
            'bilder' => $bilder = db_gerichtBilder_select_all(),
            'Alert' => $Alert = bewertung_eintragen(),
            'highlights' => $highlights = db_highlight_ratings(),
            'highlightsAnzahl' => $highlightsAnzahl = zaehler_highlight_Bewertungen(),

        ];
        return view('e_mensa.werbeseite', $vars);
    }

    public function wunschgerichte()
    {
        $vars = [
            'fehler_WG' => $fehler_WG = wunschgericht_anmeldung()
        ];
        return view('e_mensa.wunschgerichte', $vars);
    }

    public function bewertung()
    {
        //Nur angemeldete Benutzer können Gerichte bewerten
        if($_SESSION['login_ok'] == true) {

            $vars = [
                'fehler_WG' => $fehler_WG = bewertung_eintragen(),
                'array' => $array = gericht_bewerten(),
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

}