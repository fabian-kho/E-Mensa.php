<?php
use Illuminate\Database\Eloquent\Model;

class BewertungA extends Model {

    protected $primaryKey= 'id';
    protected $table= 'bewertung';
    protected $fillable = ['name','bild'];

   public function gericht_bewerten($data)
    {
        if (isset($_GET['bewertung'])) {



            $Bewertung= new BewertungA();
            $Bewertung= BewertungA::query()
                ->where('name', $data);

            $name=$Bewertung->name;
            $bild=$Bewertung->bild;

            $vars = [
                'namen' => $name,
                'bild' => $bild
            ];
        }
        return $vars;
    }
}