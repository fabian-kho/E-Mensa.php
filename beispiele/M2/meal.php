<?php
/**
 * Praktikum DBWT. Autoren:
 * Fabian, Kirchhoff, 3191755
 * Glenn, Verhaag, Matrikelnummer2
 */

const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_PARAM_SHOW_DESCRIPTION = 'show_description';

/**
 * Liste aller möglichen Allergene.
 */

$allergens = array(

        'de' => array(
            11 => 'Gluten',
            12 => 'Krebstiere',
            13 => 'Eier',
            14 => 'Fisch',
            17 => 'Milch'),

        'en' => array(
            11 => 'Gluten',
            12 => 'Crustaceans',
            13 => 'Eggs',
            14 => 'Fish',
            15 => 'Milk',

        )
);

$defaultlan = 'de';

//language requested via GET
$requested = $_GET['sprache'];

//use the requested language if it exists, otherwise the default language
$language = isset($allergens[$requested]) ? $requested : $defaultlan;



$meal = [ // Kurzschreibweise für ein Array (entspricht = array())

    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => [11, 13],
    'amount' => 42   // Anzahl der verfügbaren Gerichte.)

];

$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];

$showRatings = [];
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        if (stristr($rating['text'], $searchTerm) !== false) { //stristr berücksichtigt keine Groß-Kleinschreibung
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else {
    $showRatings = $ratings;
}

function calcMeanStars($ratings) : float { // : float gibt an, dass der Rückgabewert vom Typ "float" ist
    $sum = 0; //Summer muss 0 sein nicht 1 & i braucht man nicht
    foreach ($ratings as $rating) {
        $sum += $rating['stars'];
    }
    return $sum / count($ratings);
}

$wordsEen = array(
    'Gluten' => 'Gluten',
    'Krebstiere' => 'Crustaceans',
    'Eier' => 'Eggs',
    'Fisch' => 'Fish',
    'Milch' => 'Milk',
    'Gericht' => 'Meal',
    'Sprachauswahl' => 'Language selection',
    'Deutsch' => 'German',
    'Englisch' => 'English',
    'Enthaltene Allergene' => 'Contained allergens',
    'Bewertungen' => 'Reviews',
    'Insgesamt' => 'overall',
    'Filter' => 'Filter',
    'Suchen' => 'search',
    'Sterne' => 'Stars',
    'Preise' => 'Prices',
    'Beschreibung' => 'Description',
);

function translate($wordsEn){
    if (isset($_GET['sprache'])) {
        $lan = $_GET['sprache'];
        if ($lan == 'en') {
            foreach ($wordsEn as $word ){
                $word= array_search($word,$wordsEn,false);
            }
        }
    }
    return $word;
}


?>
<!DOCTYPE html>
<html lang="<?php $language?>">
    <head>
        <meta charset="UTF-8"/>
        <title><?php if ($language == 'en') echo $wordsEen["Gericht"] , ': '; else echo "Gericht: ";
                echo $meal['name'];?>
        </title>
        <style type="text/css">
            * {
                font-family: Arial, serif;
            }
            .rating {
                color: darkgray;
            }
        </style>
    </head>
    <body>
        <form method="get">
        <p><?php if ($language == 'en') echo $wordsEen["Sprachauswahl"] ; else echo "Sprachauswahl"; ?> | <a href="?sprache=de" id="de">Deutsch</a> |
            <a href="?sprache=en" id="en">Englisch</a></p>
        </form>
        <h1><?php if ($language == 'en') echo $wordsEen["Gericht"] , ': '; else echo "Gericht: "; echo $meal['name']; ?></h1>
        <form method="get">
            <label for="show_description"><?php if ($language == 'en') echo $wordsEen["Beschreibung"] ; else echo "Beschreibung"; ?></label>
            <input id="show_description" type="checkbox" name="show_description" >
            <input type="hidden" id="sprache" name="sprache" value="<?php echo $language ?>">
            <input id="apply" type="submit" value=<?php if ($language == 'en') echo $wordsEen["Beschreibung"] ; else echo "Beschreibung"; ?>>
        </form>
        <p><?php
            if(!empty($_GET[GET_PARAM_SHOW_DESCRIPTION]))  echo "<p>{$meal['description']}</p>";?>
        </p>
        <p><?php if ($language == 'en') echo $wordsEen["Preise"] , ': '; else echo "Preise: ";?></p>
        <?php echo
                "<ul>
                    <li>Intern: {$meal['price_intern']}</li>  
                    <br><li>Extern: {$meal['price_extern']}</li>      
                </ul>";
            ?>

        <p><?php if ($language == 'en') echo $wordsEen["Enthaltene Allergene"] , ': '; else echo "Enthaltene Allergene: ";?></p>
        <?php foreach ($allergens[$language] as $key => $value) {
            if(in_array($key,$meal['allergens'],false)){
        echo
        "<ul>
            <li>$value</li>     
        </ul>";
        }}?>
        <h1><?php if ($language == 'en'){ echo $wordsEen["Bewertungen"] , ' (' , $wordsEen["Insgesamt"] , ': ' , calcMeanStars($ratings), ')';}
        else {echo 'Bewertungen (Insgesamt: ' ,calcMeanStars($ratings) , ')';}
        ?></h1>
        <form method="get">
            <label for="search_text"><?php if ($language == 'en') echo $wordsEen["Filter"] , ': '; else echo "Filter: "; ?></label>
            <input id="search_text" type="text" name="search_text" value=<?php echo $searchTerm?>>
            <input type="submit" value=<?php if ($language == 'en') echo $wordsEen["Suchen"] ; else echo "Suchen"; ?>>
        </form>
        <table class="rating">
            <thead>
            <tr>
                <td>Text</td>
                <td><?php if ($language == 'en') echo $wordsEen["Sterne"] ; else echo "Sterne"; ?></td>
                <td>Author</td>
            </tr>
            </thead>
            <tbody>
            <?php
        foreach ($showRatings as $rating) {
            echo "<tr><td class='rating_text'>{$rating['text']}</td>
                      <td class='rating_stars'>{$rating['stars']}</td>
                      <td class='rating_author'>{$rating['author']}</td>
                  </tr>";
        }
        ?>
            </tbody>
        </table>
    </body>
</html>