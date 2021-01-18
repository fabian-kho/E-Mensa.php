<?php
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Capsule\Manager as DB;
class GerichtA extends Model{

    protected $primaryKey= 'id';
    protected $table= 'gericht';
    //protected $fillable = ['name','vegetarisch','vegan','preis_intern' ,'preis_extern' ];

    public function gericht_bewerten($name)
    {
        $test= DB::select("SELECT bildname,name FROM gericht WHERE name = ?", [$name]);
        return $test;

    }

    public function getPreisIntern(){
        $price= $this->attributes['preis_intern'];
        $priceIntern = number_format($price, 2, '.');
        return $priceIntern;
    }

    public function getPreisExtern(){
        $price= $this->attributes['preis_extern'];
        $priceExtern = number_format($price, 2, '.');
        return $priceExtern;
    }

    public function setvegetarischAttribute($value){
        $value = str_replace(' ', '', $value);
        if (stristr($value, "yes") or stristr($value, "ja")){
            $this->attributes['vegetarisch'] = 1;
        }else if(stristr($value, "no") or stristr($value, "nein")){
            $this->attributes['vegetarisch'] = 0;
        }
    }

    public function setveganAttribute($value){
        $value = str_replace(' ', '', $value);
        if (stristr($value, "yes") or stristr($value, "ja")){
            $this->attributes['vegan'] = true;
        }else if(stristr($value, "no") or stristr($value, "nein")){
            $this->attributes['vegan'] = false;
        }
    }

}