<?php

namespace App;

class Participant{

    protected $nom;
    protected $prenom;
    protected $dateNaissance;
    protected $adressemail;
    protected $profil;
    protected $categorie;
    protected $lienPhoto;
    protected $numeroDossard;

    public function setSurname($nom){

        if (!is_string($nom)){throw new NotAStringException("Le nom doit être une chaîne de caractères");}
        if (strlen($nom) > 30) {throw new StringTooLongException("Le nom doit être inférieur à 30 caractères");}
        if (strlen($nom) < 2) {throw new SurnameStringTooShortException("Le nom doit être supérieur à 1 caractère");}
        if (preg_match('/[\^£$%&*()}{@#~?><>0123456789,|=_+¬-]/', $nom)){
            throw new SpecialCharsException("Le nom ne doit pas contenir de caractères spéciaux");
        }
        $this->nom = $nom;

    }

    public function getSurname(){
        return $this->nom;
    }

    public function setName($prenom){

        if (!is_string($prenom)){throw new NotAStringException("Le nom doit être une chaîne de caractères");}
        if (strlen($prenom) > 30) {throw new StringTooLongException("Le prénom doit être inférieur à 30 caractères");}
        if (strlen($prenom) < 2) {throw new SurnameStringTooShortException("Le nom doit être supérieur à 1 caractère");}
        if (preg_match('/[\^£$%&*()}{@#~?><>0123456789,|=_+¬-]/', $prenom)){
            throw new SpecialCharsException("Le nom ne doit pas contenir de caractères spéciaux");
        }
        $this->prenom = $prenom;
    }

    public function getName(){
        return $this->prenom;
    }

    public function setMail($adressemail){
        $this->adressemail = $adressemail;
    }
    
    public function getMail(){
        return $this->adressemail;
    }

}