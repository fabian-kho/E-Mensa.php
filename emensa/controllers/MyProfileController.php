<?php
require_once('../models/gericht.php');
require_once('../models/gerichteÜbersicht.php');


/* Datei: controllers/HomeController.php */
class MyProfileController
{
    public function index(RequestData $request) {
        return view('home', ['rd' => $request ]);
    }
}