<?php

function bewertung_delete()
{

    $pdo = connectdb_PDO();

    $fehler=false;
    if (isset($_POST['delete'])) {

        try {

            $pdo->beginTransaction();

            $i=0;
            while ($_POST['ID'. $i]==null){
                $i++;
            }

            var_dump($_POST['ID' . $i]);

            $sql = "";
            //In Tabelle bewertung einfügen
            $pdo->prepare('DELETE FROM bewertung WHERE id = ?')
                ->execute([$_POST['ID'. $i]]);

            $pdo->commit();     //pdo übergeben


            $fehler = 'deleted';

            header("Refresh:0");

        } catch (PDOException $e) {
            $fehler = $e->getMessage();
            echo $e->getMessage();
        }
    }
    $pdo = null;

    return $fehler;
}

function bewertung_highlight()
{


    $color=false;
    if (isset($_POST['highlight'])) {

        $pdo = connectdb_PDO();

        try {

            $pdo->beginTransaction();


            $i=0;
            while ($_POST['ID'. $i]==null){
                $i++;
            }


            //In Tabelle bewertung einfügen
            $stmt =$pdo->prepare('Select highlight From bewertung WHERE id = ?');
            $stmt->execute([$_POST['ID'. $i]]);
            $highlightcolor = $stmt->fetch();

            //In Tabelle bewertung einfügen
            $pdo->prepare('UPDATE bewertung SET highlight = !highlight WHERE id = ?')
                ->execute([$_POST['ID'. $i]]);


            //pdo übergeben
            $pdo->commit();

            header("Refresh:0");

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    $pdo = null;

    return $highlightcolor;
}

