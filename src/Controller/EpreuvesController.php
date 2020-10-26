<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Model\DataBaseInteraction;


class EpreuvesController{

    // public function fonction1(){
    //     //echo("<br>"."EpreuvesController.php"."<br>");
    //     //echo("<br>"."fonction1 appelée");
    //     $loader = new \Twig\Loader\FilesystemLoader('src/templates');
    //     $twig = new \Twig\Environment($loader);

    //     $interaction = new DataBaseInteraction();
    //     $epreuves = $interaction->getEpreuves();
        
    //     $template = $twig->load('epreuves.html.twig');
    //     echo $template->render(['epreuves' => $epreuves]);

    //     //dump($epreuves);
    // }

    public function listeEpreuves(){
        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $interaction = new DataBaseInteraction();
        $epreuves = $interaction->getEpreuves();
        
        $template = $twig->load('epreuves.html.twig');
        echo $template->render(['epreuves' => $epreuves]);
        //echo("<br>"."listeEpreuves appelée");
    }

    public function ajouterEpreuve(){

        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('addEpreuve.html.twig');
        echo $twig->render($template);

    }

    public function recupInfos(Request $request){//appel de l'objet instancié, nommage en request

        //echo("<br>"."EpreuvesController.php"."<br>");
        //echo("<br>"."recupInfos appelée"."<br>");
        //dump($request->query);
        $lieu = $request->query->get('lieu');
        $date = $request->query->get('date');
        $id = $request->query->get('id');
        $response = new Response();
        //$response->setContent("Lieu de l'épreuve : ".$lieu."<br>Date de l'épreuve : ".$date."id de l'épreuve : ".$id);
        $response->send();

        $interaction = new DataBaseInteraction();
        $epreuve = $interaction->getEpreuves();
        
        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('detailEpreuve.html.twig');
        echo $template->render(['epreuve' => $epreuve[$id]]);
        //dump(['epreuve' => $epreuve[$id]]);

        
    }

}
//integrer objet request dans controller
//integration de twig.
//linker la bdd ? ou tableau de données en php

//1 : créer une page accueil avec bouton ajouter epreuve
//2 : créer une page ajouter epreuve avec chhamp lieu date
//3 : bdd epreuve