<?php
require_once('../models/kategorie.php');
require_once('../models/gericht.php');
require_once('../models/allergene.php');
require_once('../models/zaehler.php');
require_once('../models/newsletter.php');
require_once('../models/wunschgerichte.php');
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
        $stream= new StreamHandler(__DIR__.'/storage/logs/my_app.log', Logger::DEBUG);
        $logger= new Logger('Informationen');
        $logger->pushHandler($stream);
        $logger->warning('test123');

       // $log=logger();
        //echo $log->getName();
       // $log->info('test123');


        $vars = [
            'gerichte' => $gerichte = db_gericht_select_all_new(),
            'allergene' => $allergene = db_allergene_select_all_new(),
            'besucher' => $besucher = zaehlerBesucher(),
            'anmeldungen' => $anmeldungen = zaehlerAnmeldungen(),
            'anzahlGerichte' => $anzahlGerichte = zaehlerGerichte(),
            'fehler' => $fehler = newsletter_anmeldung(),
            'bilder' => $bilder = db_gerichtBilder_select_all()

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

}