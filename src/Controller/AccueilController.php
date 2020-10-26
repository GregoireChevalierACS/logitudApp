<?php

namespace App\Controller;


class AccueilController{

    public function fonction1(){
        
        $loader = new \Twig\Loader\FilesystemLoader('src/templates');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('accueil.html.twig');
        echo $twig->render($template);

    }

}