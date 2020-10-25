<?php

namespace App;

class Epreuve{

    protected $nomEpreuve;
    protected $listeParticipants = []; //array qui stocke les objets participants

    public function setName($nomEpreuve){

        // if (is_string($nomEpreuve)) {
        //     if (strlen($nomEpreuve) > 5) {
        //         if (strlen($nomEpreuve) < 30) {
        //             if (!preg_match('/[\^£$%&*()}{@#~?<>,|=_+¬-]/', $nomEpreuve)){
        //                 $this->nomEpreuve = $nomEpreuve;
        //             }else{
        //                 throw new SpecialCharsException("Le nom ne doit pas contenir de caractères spéciaux");
        //             }
        //         }else{
        //             throw new StringTooLongException("Le nom doit être inférieur à 30 caractères");
        //         }
        //     }else{
        //         throw new StringTooShortException("Le nom doit être supérieur à 5 caractères");
        //     }
        // }else{
        //     
        // } MAUVAISE PROG : se servir plutot de la programmation défensive (voir ci-dessous), plus lisible et plus efficace.

        if (!is_string($nomEpreuve)) {throw new NotAStringException("Le nom doit être une chaîne de caractères");}
        if (strlen($nomEpreuve) < 5) {throw new StringTooShortException("Le nom doit être supérieur à 5 caractères");}
        if (strlen($nomEpreuve) > 30) {throw new StringTooLongException("Le nom doit être inférieur à 30 caractères");}
        if (preg_match('/[\^£$%&*()}{@#~?><>,|=_+¬-]/', $nomEpreuve)){throw new SpecialCharsException("Le nom ne doit pas contenir de caractères spéciaux");}
        $this->nomEpreuve = $nomEpreuve;

    }

    public function getName(){
        return $this->nomEpreuve;
    }
    public function getListeParticipants(){
        return $this->listeParticipants;
    }

    public function getNombreParticipants(){
        return count($this->listeParticipants);
    }

// fonction ajouter participant

// fonction supprimer participant

}