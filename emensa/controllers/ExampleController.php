<?php
require_once('../models/kategorie.php');

class ExampleController
{
    public function m4_6a_queryparameter(RequestData $rd) {
        $vars = [
            'name' => $rd->query['name'] ?? 'name',
            'rd' => $rd
        ];
        return view('examples.m4_6a_queryparameter',$vars);
    }

    public function m4_6b_kategorie() {
       $data = db_kategorie_select_all();
       return view('examples.m4_6b_kategorie',['data' => $data]);
    }
}