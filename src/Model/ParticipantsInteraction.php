<?php

namespace App\Model;

use \PDO;

class ParticipantsInteraction extends DataBaseHandle{ 

    public function setParticipants($prenom, $nom, $dateNaissance, $categorie, $profil){
        $sql = "INSERT INTO participants(prenom, nom, dateNaissance, categorie, profil) VALUES (?,?,?,?,?)";
        $declaration = $this->connecte()->prepare($sql);
        $declaration->execute([$prenom, $nom, $dateNaissance, $categorie, $profil]);
    }

    public function getParticipants(){
        $sql = "SELECT * FROM participants";
        //      $sql   = 'SELECT database1.table1.name FROM database1.table1 LEFT JOIN database2.table2
        //            ON database1.table1.userid = database2.table2.userid';
        //  $result = $pdo***->query($sql);   
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

        $exportCible = 'participants_';
        $nomCSV = 'export_'.date('Y-m-d').'.csv';
        $exportCSV = '' . $exportCible . $nomCSV;
        
        $nomChamps = array();

        if(!empty($participant)){
            $nomParticipant = $participant[0];
            foreach($nomParticipant as $nomChmp => $val){
                $nomChamps[] = $nomChmp;
            }
        }

        header('Content-Type: application/excel');
        header('Content-Disposition: attachment; filename="' . $exportCSV . '"');

        ob_end_clean();
        
        $fp = fopen('php://output', 'w', "w");
        fputcsv($fp, $nomChamps);

        foreach ($participant as $row) {
            fputcsv($fp, $row);
        }

        fclose($fp);

        exit();
        // dump($nomChamps[1]);
        // die();
        }
    }