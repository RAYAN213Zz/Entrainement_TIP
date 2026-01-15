<?php

declare(strict_types=1);
namespace App\Middlewares;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
/**
* Middleware de gestion de session.
*
* Ce middleware s'assure qu'une session PHP est démarrée avant le traitement de la requête par le routeur ou le contrôleur.
*/

final class SessionMiddleware implements MiddlewareInterface
{
/**
* Méthode principale exécutée par Slim à chaque requête.
*
* @param Request $request La requête HTTP entrante.
* @param RequestHandler $handler Le gestionnaire suivant dans la pile Slim.
*
* @return Response La réponse HTTP générée après traitement.
*/
public function process(Request $request, RequestHandler $handler): Response
{
// Vérifie si aucune session n'est encore active, l'active sinon
if (session_status() === PHP_SESSION_NONE) {
session_start();
}
// Passe la main au middleware ou au contrôleur suivant
$response = $handler->handle($request);
// Retourne la réponse pour la suite du traitement
return $response;
}
}