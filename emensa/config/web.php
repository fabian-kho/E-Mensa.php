<?php
/**
 * Mapping of paths to controlls.
 * Note, that the path only support 1 level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as aspected
 */
return array(
    "/"                 => 'ExampleController@werbeseite',
    "/demo"             => "DemoController@demo",
    '/dbconnect'        => 'DemoController@dbconnect',



    // Erstes Beispiel:
    '/m4_6a_queryparameter' => 'ExampleController@m4_6a_queryparameter',
    '/m4_6b_kategorie'  => 'ExampleController@m4_6b_kategorie',
    '/m4_6c_gerichte'   => 'ExampleController@m4_6c_gerichte',
    '/m4_6d_layout'     => 'ExampleController@m4_6d_layout',
    '/m4_6d_page_1'     => 'ExampleController@m4_6d_page_1',
    '/m4_6d_page_2'     => 'ExampleController@m4_6d_page_2',

    //Werbeseite:
    '/werbeseite'      => 'ExampleController@werbeseite',
    '/wunschgerichte'      => 'ExampleController@wunschgerichte',

    //login
    '/anmeldung' => 'LoginController@index',
    '/anmeldung_verifizieren' => 'LoginController@check',
    '/abmeldung' => 'LoginController@logout',

    //bewertung
    '/bewertung' => 'RatingController@bewertung',
    '/bewertungen' => 'RatingController@bewertungen',
    '/meinebewertungen' => 'RatingController@meinebewertungen',






);