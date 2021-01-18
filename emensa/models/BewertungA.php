<?php
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Capsule\Manager as DB;

class BewertungA extends Model {

    protected $primaryKey= 'id';
    protected $table= 'bewertung';
    protected $attributes = ['name'=>'test'];

    function bewertung_delete()
    {

        $pdo = connectdb_PDO();

        $fehler=false;
        if (isset($_POST['delete'])) {

            try {

                $i=0;
                while ($_POST['ID'. $i]==null){
                    $i++;
                }

                //var_dump($_POST['ID' . $i]);
            $id = $_POST['ID' . $i];
                BewertungA::destroy($id);

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
        if (isset($_POST['highlight'])) {

            $i = 0;
            while ($_POST['ID' . $i] == null) {
                $i++;
            }

            $id = $_POST['ID' . $i];

            //In Tabelle bewertung einfügen

            $produkt = BewertungA::query()->find($id);
            $produkt->highlight = !$produkt->highlight;
            $produkt->save();
            /*
            $pdo->prepare('UPDATE bewertung SET highlight = !highlight WHERE id = ?')
                ->execute([$_POST['ID' . $i]]);
             */

            header("Refresh:0");


            return $highlightcolor;
        }
    }
}