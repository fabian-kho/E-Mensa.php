<?php
use Illuminate\Database\Eloquent\Model;

class GerichtA extends Model{

    protected $primaryKey= 'id';
    protected $table= 'gericht';
    //protected $fillable = ['name','vegetarisch','vegan','preis_intern' ,'preis_extern' ];

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

    public function setVegetarian($value){
        $value = str_replace(' ', '', $value);
        if (stristr('ja',$value) === TRUE || stristr('yes',$value) === TRUE) {
            $this->attributes['vegetarisch'] = true;
        }
        else {
            $this->attributes['vegetarisch'] = false;
        }
    }

    public function setVegan($value){
        $value = str_replace(' ', '', $value);
        if (stristr('ja',$value) === TRUE || stristr('yes',$value) === TRUE) {
            $this->attributes['vegan'] = true;
        }
        else {
            $this->attributes['vegan'] = false;
        }
    }

}