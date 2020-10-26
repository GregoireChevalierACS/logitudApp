<?php

namespace App\Model;

class DataBaseInteraction extends DataBaseHandle{ 

    public function getEpreuves(){
        //echo("getEpreuves() appelée" . "<br>");
        $sql = "SELECT * FROM epreuves";
        $declaration = $this->connecte()->query($sql);
        $one = $declaration->fetchAll();
            
        return $one;

    }

}