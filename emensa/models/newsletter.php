<?php

/** Füge die Gerichte (inklusive der Allergene) in die Tabelle ein **********************************/
function newsletter_anmeldung()
{
    $blacklist = [1 => 'rcpt.at',
        2 => 'damnthespam.at',
        3 => 'wegwerfmail.de',
        4 => 'trashmail.de',
        5 => 'trashmail.com'];

    function find_text_in_array(array $array, $text): bool
    {
        foreach ($array as $key => &$value) {
            if (strpos($text, $value) !== false) {
                return true;
            }
        }
        return false;
    }

    $fehler = false;
    if (isset($_POST['submit'])) {

        $newsletter = [
            'name' => trim($_POST['name'] ?? NULL), //gesetzt?
            'email' => trim($_POST['email'] ?? NULL),
            'sprache' => trim($_POST['sprache'] ?? NULL),
            'datenschutz' => $_POST['Datenschutz'] ?? NULL
        ];

        //Benutzereingabe in HTML Code umwandeln um XSS zu verhindern
        $newsletter['name']=strip_tags($newsletter['name']);
        $newsletter['name']=htmlspecialchars($newsletter['name']);
        $newsletter['email']=htmlspecialchars($newsletter['email']);

        //Prüfen ob leer?
        if (empty($newsletter['name'])) {
            $fehler = 'Der Name darf nicht leer sein.';
        }

        //E-Mail validierung
        if (!filter_var($newsletter['email'], FILTER_VALIDATE_EMAIL)) {
            $fehler = 'Die E-Mail hat das falsche Format.';
            if (empty($newsletter['email'])) {
                $fehler = 'Die E-Mail darf nicht leer sein.';
            }
        }

        //E-mail auf zulässigkeit prüfen
        if (find_text_in_array($blacklist, $newsletter['email'])) {
            $fehler = 'Diese E-Mail ist nicht zulässig.';
        }

        //Store
        if (!$fehler) {
            $Userdata = file_put_contents('db/NL_Anmeldungen.txt', serialize($newsletter) . "\r\n", FILE_APPEND);
            $fehler='stored';
        }
    }
    return $fehler;
}

