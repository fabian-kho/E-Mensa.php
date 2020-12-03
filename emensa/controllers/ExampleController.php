<?php
require_once('../models/kategorie.php');
require_once('../models/gericht.php');


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

    public function m4_6c_gerichte() {
        $data = db_gericht_select_all();
        return view('examples.m4_6c_gerichte',['data' => $data]);
    }
    public function m4_6d_layout(RequestData $rd) {
        $vars = [
            'no' => $rd->query['no'] ?? '1',
            'rd' => $rd
        ];
        if($vars['no']== '2')
            return $this->m4_6d_page_2();
        else if($vars['no']== '1')
            return $this->m4_6d_page_1();
    }
    public function m4_6d_page_1() {
        $vars = [
        'data' => $data = db_gericht_select_all(),
        'title' => $title = 'Page 1'
        ];
        return view('examples.pages.m4_6d_page_1',$vars);
    }
    public function m4_6d_page_2() {
        $vars = [
            'data' => $data = db_kategorie_select_all(),
            'title' => $title = 'Page 2'
        ];
        return view('examples.pages.m4_6d_page_2',$vars);
    }

    public function werbeseite() {
        $vars = [
            'data' => $data = db_gericht_select_all(),
            'title' => $title = 'E-Mensa'
        ];
        return view('e_mensa.werbeseite',$vars);
    }
    /*public function layout() {
        $vars = [
            'data' => $data = db_gericht_select_all(),
            'title' => $title = 'E-Mensa'
        ];
        return view('e_mensa.e_mensa',$vars);
    }*/


}