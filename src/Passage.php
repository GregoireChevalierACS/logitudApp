<?php


namespace App;

class Passage{

    protected $passageNumber;

    public function setPassageNumber($passageNumber){

        if (is_int($passageNumber)) {
           if ($passageNumber <= 2) {
                if($passageNumber > 0 ){
                    $this->passageNumber = $passageNumber;
                }else{
                    throw new NegativeNumberException("Le nombre ne doit pas être négatif");
                }
           }else{
               throw new HighNumberException("Le nombre ne doit pas être supérieur à 2");
           }
        }else{
            throw new NonIntegerNumberException("Le nombre doit être un entier");
        }

    }

    public function getNumber(){
        return $this->passageNumber;
    }

}