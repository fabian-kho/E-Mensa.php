<?php
/**
 * Praktikum DBWT. Autoren:
 * Fabian, Kirchhoff, 3191755
 * Vorname2, Nachname2, Matrikelnummer2
 */

$meals = [
        'meal1' => ['name' => 'Rindfleisch mit Bambus, Kaiserschoten und rotem Paprika, dazu Nudeln',
                    'price_intern' => "3,50",
                    'price_extern' => "6,20",
                    'image' => "Rindfleisch.jpg"],

        'meal2' => ['name' => 'Spinatrisotto mit kleinen Samosateigecken und gemischtem Salat',
                    'price_intern' => "2,90",
                    'price_extern' => "5,30",
                    'image' => "Spinatrisotto.jpg"],

        'meal3' => ['name' => 'Mensa Cheeseburger mit Salat',
                    'price_intern' => "3,50",
                    'price_extern' => "4,50",
                    'image' => "burger.jpg"],

        'meal4' => ['name' => 'Hot Dogs mit verschiedenem Gemüse, Senf und Ketchup',
                    'price_intern' => "4,50",
                    'price_extern' => "5,10",
                    'image' => "hotdog.jpg"]
];

file_put_contents('meals.txt',serialize($meals));
