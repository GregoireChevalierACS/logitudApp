<?php

namespace App\Model;

use \PDO;

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

    public function deleteParticipant($id){
        
        $sql = "DELETE FROM `participants` WHERE `participants`.`id` = $id ";
        $declaration = $this->connecte()->prepare($sql);
        $declaration->execute([$id]);

    }

    public function exporteParticipants(){
        // $sql = "SELECT prenom, nom, dateNaissance, categorie, profil, temps1, temps2
        // FROM participants
        // INTO OUTFILE 'C:\wamp64\www\w_projet_01_logitud\logitudApp\exports\participants.csv'
        // FIELDS TERMINATED BY ','
        // ENCLOSED BY ''
        // LINES TERMINATED BY '\n'";
        $sql = "SELECT * FROM participants";
        $declaration = $this->connecte()->query($sql);
        $participant = $declaration->fetchAll(PDO::FETCH_ASSOC);
        $exportCible = 'participants';
        $nomCSV = 'db_export_'.date('Y-m-d').'.csv';
        $exportCSV = '';
        
        $nomChamps = array();

        if(!empty($participant)){
            $nomParticipant = $participant[0];
            foreach($nomParticipant as $nomChmp => $val){
                $nomChamps[] = $nomChmp;
            }
        }

        dump($nomChamps[1]);
        die();
        
    }
}