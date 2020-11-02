<?php

namespace App\Model;

use \PDO;

class EpreuvesInteraction extends DataBaseHandle{ 

    public function getEpreuves(){
        $sql = "SELECT * FROM epreuves";
        $declaration = $this->connecte()->query($sql);
        $one = $declaration->fetchAll();
        //dump($one)  ; 
        return $one;
    }

    public function setEpreuves($lieu, $date){
        $sql = "INSERT INTO epreuves(lieu, date) VALUES (?,?)";
        $declaration = $this->connecte()->prepare($sql);
        $declaration->execute([$lieu, $date]);
    }

    public function deleteEpreuve($id){
        
        $sql = "DELETE FROM `epreuves` WHERE `epreuves`.`id` = $id ";
        $declaration = $this->connecte()->prepare($sql);
        $declaration->execute([$id]);

    }
    

    public function exporteEpreuves(){

        $sql = "SELECT * FROM epreuves";
        $declaration = $this->connecte()->query($sql);
        $epreuve = $declaration->fetchAll(PDO::FETCH_ASSOC);

        $exportCible = 'epreuves_';
        $nomCSV = 'export_'.date('Y-m-d').'.csv';
        $exportCSV = '' . $exportCible . $nomCSV;
        
        $nomChamps = array();

        if(!empty($epreuve)){
            $nomEpreuve = $epreuve[0];
            foreach($nomEpreuve as $nomChmp => $val){
                $nomChamps[] = $nomChmp;
            }
        }

        header('Content-Type: application/excel');
        header('Content-Disposition: attachment; filename="' . $exportCSV . '"');

        $fp = fopen('php://output', 'w');
        fputcsv($fp, $nomChamps);

        foreach ($epreuve as $row) {
            fputcsv($fp, $row);
        }

        fclose($fp);
    }
}