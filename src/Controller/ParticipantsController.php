<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Model\EpreuvesInteraction;
use App\Model\ParticipantsInteraction;

class ParticipantsController{

    public function ajouterParticipant(Request $request){
        
        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);
//
        $interaction = new EpreuvesInteraction();
        $epreuve = $interaction->getEpreuves();
        $val = array_column($epreuve, null, 'id');
        $id = $request->query->get('id');
        
        $template = $twig->load('Participants/addParticipant.html.twig');
        echo $template->render(['epreuve' => $val[$id]]);

    }

    public function participantAjoute(Request $request){
        echo("<br>"."participantAjoute appelée");
        $prenom = $request->get('prenom');
        $nom = $request->get('nom');
        $dateNaissance = $request->get('dateNaissance');
        $categorie = $request->get('categorie');
        $profil = $request->get('profil');
        // dump($request);
        // die();

        $interaction = new EpreuvesInteraction();
        $epreuve = $interaction->getEpreuves();
        $interaction2 = new ParticipantsInteraction();
        $interaction2->setParticipants($prenom, $nom, $dateNaissance, $categorie, $profil);
        $val = array_column($epreuve, null, 'id');
        $id = $request->query->get('id');

        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('Participants/participantAjoute.html.twig');
        echo $template->render(['epreuve' => $val[$id]]);
    }

    public function listeParticipants(){
        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $interaction = new ParticipantsInteraction();
        $participants = $interaction->getParticipants();
        //lier table epreuves avec participants et participants avec passages
        $template = $twig->load('Participants/participants.html.twig');
        echo $template->render(['participants' => $participants]);
    }

    public function supprimerParticipant(Request $request){
        
        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);
//
        $interaction = new ParticipantsInteraction();
        $participants = $interaction->getParticipants();
        $val = array_column($participants, null, 'id');
        $id = $request->query->get('id');
        
        $template = $twig->load('Participants/supprimerParticipant.html.twig');
        echo $template->render(['participants' => $val[$id]]);

    }

    public function participantSupprime(Request $request){

        $id = $request->query->get('id');
        $interaction = new ParticipantsInteraction();
        $participants = $interaction->getParticipants();
        $interaction->deleteParticipant($id);
        $val = array_column($participants, null, 'id');
        
        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('Participants/participantSupprime.html.twig');
        echo $template->render(['participants' => $val[$id]]);
    }

    public function export(){
        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $interaction = new ParticipantsInteraction();
        $interaction->exporteParticipants();
        
        $template = $twig->load('General/export.html.twig');
        echo $twig->render($template);
    }
}