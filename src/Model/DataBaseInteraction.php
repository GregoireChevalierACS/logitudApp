<?php

namespace App\Model;

class DataBaseInteraction extends DataBaseHandle{ 

    public function getEpreuves(){
        //echo("getEpreuves() appelée" . "<br>");
        $sql = "SELECT * FROM epreuves";
        $declaration = $this->connecte()->query($sql);
        $one = $declaration->fetchAll();
        //dump($one)  ; 
        return $one;
    }

    public function setEpreuves($lieu, $date){
        //echo("setEpreuves() appelée" . "<br>");
        $sql = "INSERT INTO epreuves(lieu, date) VALUES (?,?)";
        $declaration = $this->connecte()->prepare($sql);
        $declaration->execute([$lieu, $date]);
    }

    public function deleteEpreuve($id){

        $sql = "DELETE FROM `epreuves` WHERE `epreuves`.`id` = $id ";
        $declaration = $this->connecte()->prepare($sql);
        $declaration->execute([$id]);

    }

}