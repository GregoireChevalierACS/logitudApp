<?php

require "vendor/autoload.php"; 

use App\Controller\AccueilController;
use App\Controller\EpreuvesController;
use App\Controller\ParticipantsController;
use Symfony\Component\HttpFoundation\Request;


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [new AccueilController(), 'fonction1']);
    $r->addRoute('GET', '/index/epreuves', [new EpreuvesController(), 'listeEpreuves']);
    $r->addRoute('GET', '/index/ajouterEpreuve', [new EpreuvesController(), 'ajouterEpreuve']);
    $r->addRoute('GET', '/index/epreuve/{lieu}/{date}/{id}', [new EpreuvesController(), 'recupInfos']);
    $r->addRoute('GET', '/index/epreuves/{lieu}/{date}/ajouterParticipants', [new ParticipantsController(), 'fonction1']);
  });

$request = Request::createFromGlobals(); // instancie l'objet request

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo()); // définit l'objet request

switch ($routeInfo[0]) {
     case FastRoute\Dispatcher::NOT_FOUND:
         //... 404 Not Found
         echo("<br>"."cas 1 ; routeInfo[0], Route not found");
         break;
     case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
         $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
         echo("<br>"."cas 2 ; routeInfo[1]");
         break;
     case FastRoute\Dispatcher::FOUND:
         $handler = $routeInfo[1];
         $vars = $routeInfo[2];
         $request->query->add($routeInfo[2]);
         call_user_func_array($handler, [$request]);
         break;
 }

