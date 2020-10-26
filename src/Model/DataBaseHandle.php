<?php

namespace App\Model;
use \PDO;

class DataBaseHandle{ 
private $dbhost = "localhost";
private $dbuser = "root";
private $dbpass = "";
private $dbname = "logitud1";

protected function connecte(){
     //echo("connexion à la bdd" . "<br>");
     $dataSourceName = 'mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname;
     $pdo = new PDO($dataSourceName, $this->dbuser, $this->dbpass);
     $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
     return $pdo;
}


}