<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Model\DataBaseInteraction;

class ParticipantsController{

    public function ajouterParticipant(Request $request){
        
        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);
//
        $interaction = new DataBaseInteraction();
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
        // dump($request);
        // die();

        $interaction = new DataBaseInteraction();
        $epreuve = $interaction->getEpreuves();
        $interaction2 = new DataBaseInteraction();
        $interaction2->setParticipants($prenom, $nom);
        $val = array_column($epreuve, null, 'id');
        $id = $request->query->get('id');

        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('Participants/participantAjoute.html.twig');
        echo $template->render(['epreuve' => $val[$id]]);
    }

}