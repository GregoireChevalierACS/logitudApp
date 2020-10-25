<?php
include "dbconnection.php";
class DataBaseInteraction extends DataBaseHandle{ 

    public function getEpreuves(){
        echo("getEpreuves() appelée" . "<br>");
        $sql = "SELECT * FROM epreuves";
        $declaration = $this->connecte()->query($sql);
        while ($one = $declaration->fetch()){
            echo( "Épreuve de : " . $one['lieu'] . " se déroulant le : " . $one['date'] . "<br>");
        }
    }

}