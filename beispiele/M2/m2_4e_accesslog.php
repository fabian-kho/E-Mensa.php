<?php
/**
 * Praktikum DBWT. Autoren:
 * Fabian, Kirchhoff, 3191755
 * Vorname2, Nachname2, Matrikelnummer2
 */

date_default_timezone_set("Europe/Berlin");
$timestamp=time();

$clientIP=$_SERVER['REMOTE_ADDR'];              //Returns the IP address from where the user is viewing the current page
$time=date("H:i",$timestamp);            //Time
$date=date("d.m.Y",$timestamp);          //Date

//In array Eintragen
$alles[]=$date;
$alles[]=$time;
$alles[]=$clientIP;


//Quelle:https://stackoverflow.com/questions/2257597/reliable-user-browser-detection-with-php
//Prüfen welcher Webbrowser vom Client verwendet wird, mithilfe von $_SERVER['HTTP_USER_AGENT']
if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
    $alles[]='Internet explorer';
elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
    $alles[]='Internet explorer';
elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
    $alles[]='Mozilla Firefox';
elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
    $alles[]='Google Chrome';
elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
    $alles[]='Opera Mini';
elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
    $alles[]='Opera';
elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
    $alles[]='Safari';
else
    $alles[]='Something else';

//File öffnen und das Array $alles serialisieren und in Datei schreiben
file_put_contents('accesslog.txt', serialize($alles)."\r\n",FILE_APPEND);


