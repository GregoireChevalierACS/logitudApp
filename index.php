<?php

use function Composer\Autoload\includeFile;

require "vendor/autoload.php";
 

use App\Controller\AccueilController;
use App\Controller\EpreuvesController;
use App\Controller\ParticipantsController;
use Symfony\Component\HttpFoundation\Request;


echo("index.php");

// $loader = new \Twig\Loader\FilesystemLoader('src/templates');
// $twig = new \Twig\Environment($loader);

// $template = $twig->load('base.html.twig');
// echo $twig->render($template);

// $interaction = new DataBaseInteraction();
// $epreuves = $interaction->getEpreuves();


//dump($epreuves);

// echo $twig->render('epreuve.html', array(
//     'lieu' => 'aix',
//     'date' => '8 Janvier',
//     'epreuves' => array(
//         array('lieu' => 'aix', 'date' => '8 Janvier'),
//         array('lieu' => 'val tho', 'date' => '9 Janvier'),
//         array('lieu' => 'mont blanc', 'date' => '10 Janvier')
//     )
// ));


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [new AccueilController(), 'fonction1']);
    $r->addRoute('GET', '/index/epreuves', [new EpreuvesController(), 'fonction1']);
    $r->addRoute('GET', '/index/ajouterEpreuve', [new EpreuvesController(), 'ajouterEpreuve']);
    $r->addRoute('GET', '/index/epreuves/{lieu}/{date}', [new EpreuvesController(), 'recupInfos']);
    $r->addRoute('GET', '/index/epreuves/{lieu}/{date}/ajouterParticipants', [new ParticipantsController(), 'fonction1']);
    //mettre les parametres dans la route
    //récupérer les parametres (pathinfo ? -> httpfoundation)
});

// $httpMethod = $_SERVER['REQUEST_METHOD'];
// $uri = $_SERVER['REQUEST_URI'];

// $uri = rawurldecode($uri);
$request = Request::createFromGlobals(); // instancie l'objet request

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo()); // définit l'objet request
//var_dump($routeInfo);
// $params = $routeInfo[1];
//$test = $routeInfo[2];
// var_dump($test);
// die();


//$lieu = $request->query->;

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
         //$request->query->add($routeInfo[2]);
         $vars = $routeInfo[2];
        // ... call $handler with $vars
         //call_user_func([$params[0], $params[1]]);
        //call_user_func_array($handler, [$vars]);
        $request->query->add($routeInfo[2]);
        call_user_func_array($handler, [$request]);
         //passer l'objet request au lieu du tableau de para.
         //instancier l'objet request et lui passer les para du routeur
         //echo("<br>"."cas 3, ça marche");
         break;
 }





//composer init
//composer require fast route (la bonne ldc par contre)
//autoload
// php -S localhost8000
//creer un testController (class) avec namespace
//localhost/test -> testController :: index
//handler = exécute 
// ->enregistre les routes disponibles
//$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
//    $r->addRoute('GET', '/test', [new testController(), 'methodeDuController']);
//});
// lit les informations de la route à exécuter
// $httpMethod = $_SERVER['REQUEST_METHOD'];
// $uri = $_SERVER['REQUEST_URI'];
//// Fetch method and URI from somewhere
//$uri = rawurldecode($uri);
//récupère les informations de la route à appeler
//$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
//$params = $routeInfo[1];
//dump($params);
//call_user_func([$params[0], $params[1]]);
// switch ($routeInfo[0]) {
//     case FastRoute\Dispatcher::NOT_FOUND:
//         // ... 404 Not Found
//         break;
//     case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
//         $allowedMethods = $routeInfo[1];
//         // ... 405 Method Not Allowed
//         break;
//     case FastRoute\Dispatcher::FOUND:
//         $handler = $routeInfo[1];
//         $vars = $routeInfo[2];
//         // ... call $handler with $vars
//         break;
// }
//toutes les routes doivent passer par le routeur (index)

//var_dump($request);
//request = POST
//query = GET
// $request = new Request(
//     $_GET,
//     $_POST,
//     [],
//     $_COOKIE,
//     $_FILES,
//     $_SERVER
// );
//die();
//httpfoundation permet de convertir les requetes en objets.
//routeur httpfoundation