<?php
declare(strict_types=1);
// Active le typage strict pour renforcer la fiabilité du code (vérifie les types des paramètres et retours).
namespace App\Middlewares;
// Définit le namespace de la classe, pour l'organisation du projet et l'autoloading via Composer.

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteContext;
use Slim\Views\PhpRenderer;
/**
* Middleware ViewGlobalsMiddleware
* --------------------------------
* Ce middleware a pour rôle d'ajouter des variables globales au moteur de rendu des vues (PhpRenderer).
* Il injecte notamment :
* - le contenu de la balise <head> (via HeadComponent)
* - le menu de navigation (via NavComponent)
*
* Cela permet de rendre ces éléments automatiquement disponibles dans toutes les vues,
* sans avoir à les fournir manuellement dans chaque contrôleur.
*/
final class ViewGlobalsMiddleware implements MiddlewareInterface
{
/**
* Constructeur : on injecte les dépendances nécessaires
*
* @param PhpRenderer $view Moteur de rendu pour les vues (fichiers .php).
*/
public function __construct(
private PhpRenderer $view
) {
}
/**
* Méthode process() : exécutée automatiquement par Slim à chaque requête HTTP.
*
* @param Request $request La requête HTTP entrante.
* @param RequestHandler $handler Le middleware ou contrôleur suivant dans la chaîne.
*
* @return Response La réponse HTTP finale.
*/
public function process(Request $request, RequestHandler $handler): Response
{
// Récupère le contexte de la route courante à partir de la requête.
// Cela permet d'obtenir la route active et le route parser de Slim.
$routeContext = RouteContext::fromRequest($request);
$route = $routeContext->getRoute();
$parser = $routeContext->getRouteParser();
// Détermine le nom de la route actuelle (ex. 'home', 'about'),
// ou, si aucune route n'est trouvée, utilise le chemin brut de l'URL.
$current = $route ? ($route->getName() ?? '') : trim($request->getUri()->getPath(), '/');
// Construit un tableau des URL principales du site
// à partir des noms de routes définis dans App\Routes\Web.
$urls = [   
'home' => $parser->relativeUrlFor('home') ?? '/',
//'about' => $parser->relativeUrlFor('about') ?? '/about',
];
// Ajoute dans le moteur de rendu les versions HTML des composants partagés :
// - le <head> (métadonnées, CSS, favicon, etc.)
// - la barre de navigation avec la page active mise en évidence.
// Transmet la requête au middleware ou au contrôleur suivant.
// La réponse finale (vue + layout) sera générée plus bas dans la pile Slim.
return $handler->handle($request);
}
}