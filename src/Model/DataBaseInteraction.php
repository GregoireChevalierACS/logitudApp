<?php

namespace App\Model;

class DataBaseInteraction extends DataBaseHandle{ 

    public function getEpreuves(){
        //echo("getEpreuves() appelée" . "<br>");
        $sql = "SELECT * FROM epreuves";
        $declaration = $this->connecte()->query($sql);
        $one = $declaration->fetchAll();
        //dump($one)  ; 2
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

    public function setParticipants($prenom, $nom, $dateNaissance, $categorie, $profil){
        //echo("setParticipants() appelée" . "<br>");
        $sql = "INSERT INTO participants(prenom, nom, dateNaissance, categorie, profil) VALUES (?,?,?,?,?)";
        $declaration = $this->connecte()->prepare($sql);
        $declaration->execute([$prenom, $nom, $dateNaissance, $categorie, $profil]);
    }

    public function getParticipants(){
        $sql = "SELECT * FROM participants";
        $declaration = $this->connecte()->query($sql);
        $two = $declaration->fetchAll();
        return $two;
    }
}