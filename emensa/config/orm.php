<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "mysql",
    "host" => "localhost",
    "database" => "e_mensa",
    "username" => "root",
    "password" => "root123"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();