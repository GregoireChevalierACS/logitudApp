<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Model\EpreuvesInteraction;


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

        $interaction = new EpreuvesInteraction();
        $epreuves = $interaction->getEpreuves();
        
        $template = $twig->load('Epreuves/epreuves.html.twig');
        echo $template->render(['epreuves' => $epreuves]);
        //echo("<br>"."listeEpreuves appelée");
    }

    public function ajouterEpreuve(){

        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);
//
        $template = $twig->load('Epreuves/addEpreuve.html.twig');
        echo $twig->render($template);

    }

    public function epreuveAjoutee(Request $request){
        echo("<br>"."epreuveAjoutee appelée");
        $lieu = $request->get('lieu');
        $date = $request->get('date');
        // dump($lieu);
        // die();

        $interaction = new EpreuvesInteraction();
        $interaction->setEpreuves($lieu, $date);

        //$nouvelleEpreuve = $interaction->setEpreuves("Mont-Cul", "2020-12-12");
        //$interaction->setEpreuves("Mont-Cul", "2020-12-12"); // remplacer par un form
        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('Epreuves/epreuveAjoutee.html.twig');
        echo $twig->render($template);
    }
    
    public function supprimerEpreuve(Request $request){
        
        $interaction = new EpreuvesInteraction();
        $epreuve = $interaction->getEpreuves();

        $val = array_column($epreuve, null, 'id');
        $id = $request->query->get('id');

        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('Epreuves/supprimerEpreuve.html.twig');
        echo $template->render(['epreuve' => $val[$id]]);

    }

    public function epreuveSupprimee(Request $request){
        echo("<br>"."epreuveSupprimee appelée");

        $id = $request->query->get('id');
        $interaction = new EpreuvesInteraction();
        $interaction->deleteEpreuve($id);
        
        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('Epreuves/epreuveSupprimee.html.twig');
        echo $twig->render($template);
    }

    public function recupInfos(Request $request){//appel de l'objet instancié, nommage en request

        //dump($request->query);
        //$lieu = $request->query->get('lieu');
        //$date = $request->query->get('date');
        $id = $request->query->get('id');
        //$response = new Response();
        //$response->setContent("Lieu de l'épreuve : ".$lieu."<br>Date de l'épreuve : ".$date."id de l'épreuve : ".$id);
        //$response->send();

        $interaction = new EpreuvesInteraction();
        $epreuve = $interaction->getEpreuves();
        
        // foreach($epreuve as $arr) foreach($arr as $k=>$v) $arrayIndex[$k][] = $v; VERSION PLUS PROPRE DE çA CI-DESSOUS
        // $val = array_search($id, $arrayIndex['id']);
        $val = array_column($epreuve, null, 'id');

        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('Epreuves/detailEpreuve.html.twig');
        echo $template->render(['epreuve' => $val[$id]]);
    }  
    
    public function export(){
        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $interaction = new EpreuvesInteraction();
        $interaction->exporteEpreuves();
        
        $template = $twig->load('General/export.html.twig');
        echo $twig->render($template);
    }

}