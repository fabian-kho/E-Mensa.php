<?php
/**
 * Praktikum DBWT. Autoren:
 * Fabian, Kirchhoff, 3191755
 * Glenn, Verhaag, 3173673
 */

$meals = [
        'meal1' => ['name' => 'Rindfleisch mit Bambus, Kaiserschoten und rotem Paprika, dazu Nudeln',
                    'price_intern' => "3,50",
                    'price_extern' => "6,20",
                    'mySlides' => "Rindfleisch.jpg"],

        'meal2' => ['name' => 'Spinatrisotto mit kleinen Samosateigecken und gemischtem Salat',
                    'price_intern' => "2,90",
                    'price_extern' => "5,30",
                    'mySlides' => "Spinatrisotto.jpg"],

        'meal3' => ['name' => 'Mensa Cheeseburger mit Salat',
                    'price_intern' => "3,50",
                    'price_extern' => "4,50",
                    'mySlides' => "burger.jpg"],

        'meal4' => ['name' => 'Hot Dogs mit verschiedenem Gemüse, Senf und Ketchup',
                    'price_intern' => "4,50",
                    'price_extern' => "5,10",
                    'mySlides' => "hotdog.jpg"]
];

file_put_contents('meals.txt',serialize($meals));
