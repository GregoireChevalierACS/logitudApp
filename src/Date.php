<?php

namespace App;

use DateTime;

class Date{

protected $date;
protected $now;
protected $dateMonth;
protected $dateDay;
protected $dateYear;
// = new DateTime();

public function setDate($dateMonth, $dateDay, $dateYear){

    

    if (checkdate($dateMonth,$dateDay,$dateYear)) {
        
        // if (date donnée > date actuelle) {
            $this->dateMonth = $dateMonth;  
            $this->dateDay = $dateDay;
            $this->dateYear = $dateYear;
        // }else{
        //     throw new PastDateException("La date fournie ne doit pas être déjà passée.");
        // }
    }else{
        throw new DateFormatException("Le format de la date est incorrect.");
    }

}

public function getDate(){
    return $this->dateMonth;
    return $this->dateDay;
    return $this->dateYear;
}

}