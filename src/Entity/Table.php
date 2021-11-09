<?php

namespace App\Entity;

class Table {


    public function __construct($numero){
        $this->numero = $numero;
    }

    public function calcMultiply($num){
        $result= array();
        $calculation= array();
        //generer le tab de calcul
        for ($i=0; $i < $num ; $i++){
            
            $calculation['indice']=  $i+1;
            $calculation['result']=  $this->numero * ($i +1);
            
            $result[] = $calculation ;
        }
        return $result;
    }

}