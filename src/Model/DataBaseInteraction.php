<?php

namespace App\Model;

use App\Participant;

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

    public function exporteParticipants(){
        $exportCible = 'participants';
        $nomCSV = 'db_export_'.date('Y-m-d').'.csv';
        $sql = "SELECT prenom, nom, dateNaissance, categorie, profil, temps1, temps2
        FROM participants
        INTO OUTFILE 'C:\wamp64\www\w_projet_01_logitud\logitudApp\exports\participants.csv'
        FIELDS TERMINATED BY ','
        ENCLOSED BY ''
        LINES TERMINATED BY '\n'";
        $declaration = $this->connecte()->query($sql);
        return $declaration;
        // $three = $declaration->fetchAll();
        // $exportCSV = '';
        // dump($three);
        // die();
    }
}