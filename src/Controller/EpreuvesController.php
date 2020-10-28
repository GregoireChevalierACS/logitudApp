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
        dump($request);
        $interaction = new DataBaseInteraction();
        //$nouvelleEpreuve = $interaction->setEpreuves("Mont-Cul", "2020-12-12");
        //$interaction->setEpreuves("Mont-Cul", "2020-12-12"); // remplacer par un form
        die();

        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('Epreuves/epreuveAjoutee.html.twig');
        echo $twig->render($template);
    }
    
    public function supprimerEpreuve(Request $request){
        
        $interaction = new DataBaseInteraction();
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
        $interaction = new DataBaseInteraction();
        $interaction->deleteEpreuve($id);
        // dump($id);
        // die();
        
        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('Epreuves/epreuveSupprimee.html.twig');
        echo $twig->render($template);
    }

    public function recupInfos(Request $request){//appel de l'objet instancié, nommage en request

        //echo("<br>"."EpreuvesController.php"."<br>");
        //echo("<br>"."recupInfos appelée"."<br>");
        //dump($request->query);
        //$lieu = $request->query->get('lieu');
        //$date = $request->query->get('date');
        $id = $request->query->get('id');
        //$response = new Response();
        //$response->setContent("Lieu de l'épreuve : ".$lieu."<br>Date de l'épreuve : ".$date."id de l'épreuve : ".$id);
        //$response->send();

        $interaction = new DataBaseInteraction();
        $epreuve = $interaction->getEpreuves();
        
        // foreach($epreuve as $arr) foreach($arr as $k=>$v) $arrayIndex[$k][] = $v; VERSION PLUS PROPRE DE çA CI-DESSOUS
        // dump($arrayIndex);
        // $val = array_search($id, $arrayIndex['id']);
        // dump($val);
        $val = array_column($epreuve, null, 'id');
        //dump($val[$id]);

        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('Epreuves/detailEpreuve.html.twig');
        echo $template->render(['epreuve' => $val[$id]]);
        
        //dump(['epreuve' => $epreuve[$date]]);

        
    }

}
//integrer objet request dans controller
//integration de twig.
//linker la bdd ? ou tableau de données en php

//1 : créer une page accueil avec bouton ajouter epreuve
//2 : créer une page ajouter epreuve avec chhamp lieu date
//3 : bdd epreuve
//({% for key,value in donnees[0] %})