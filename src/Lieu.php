<?php

namespace App;

class Lieu{

protected $lieu;

public function setName($lieu){

    
    if (is_string($lieu)) {
        if (strlen($lieu) > 2) {
            if (strlen($lieu) < 40) {
                if (!preg_match('/[\^£$%&*()}{@#~?><>,|=_+¬-]/', $lieu)){
                    $this->lieu = $lieu;
                }else{
                    throw new SpecialCharsException("Le nom du lieu ne doit pas contenir de caractères spéciaux");
                }
            }else{
                throw new StringTooLongException("Le nom du lieu doit être inférieur à 40 caractères");
            }
        }else{
            throw new StringTooShortException("Le nom du lieu doit être supérieur à 2 caractères");
        }
    }else{
        throw new NotAStringException("Le nom du lieu doit être une chaîne de caractères");
    }
    
}

public function getName(){
    return $this->lieu;
}


}