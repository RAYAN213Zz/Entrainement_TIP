<?php
declare(strict_types=1);
// Active le typage strict : les types des paramètres et retours seront vérifiés strictement.
namespace App\Middlewares;
// Définit l'espace de noms pour organiser la classe dans la structure du projet.
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\PhpRenderer;
use Throwable;
/**
* Classe ErrorHandler
* -------------------
* Ce composant gère les erreurs globales de l'application Slim.
* Il est utilisé comme gestionnaire d'erreurs par défaut (Default Error Handler)
* et permet d'afficher des pages personnalisées pour les erreurs 404 et 500.
*/
final class ErrorHandler
{
/**

* Constructeur : injection des dépendances nécessaires
*
* @param ResponseFactoryInterface $responseFactory Sert à créer les objets Response.
* @param PhpRenderer $view Sert à afficher les pages d'erreurs.
*/
public function __construct(
private ResponseFactoryInterface $responseFactory,
private PhpRenderer $view
) {
}
/**
* Méthode __invoke : appelée automatiquement par Slim lorsqu'une erreur survient.
*
* @param Request $request La requête HTTP ayant provoqué l'erreur.
* @param Throwable $exception L'exception ou l'erreur interceptée.
* @param bool $displayErrorDetails Indique si les détails de l'erreur doivent être affichés
* (utile en mode développement).
* @param bool $logErrors Indique si les erreurs doivent être journalisées.
* @param bool $logErrorDetails Indique si les détails des erreurs doivent être loggés.
*
* @return Response Une réponse HTTP contenant la page d'erreur.
*/
public function __invoke(
Request $request,
Throwable $exception,
bool $displayErrorDetails,
bool $logErrors,
bool $logErrorDetails
): Response {
// Crée une nouvelle réponse vide via la fabrique.
$response = $this->responseFactory->createResponse();
// Valeurs par défaut : erreur 500 (erreur serveur)
$status = 500;
$template = '500.php'; // vue à afficher pour une erreur serveur
$data = ['pagetitle' => 'Erreur serveur']; // données transmises à la vue
// Si l'erreur est une 404 (route non trouvée)
if ($exception instanceof HttpNotFoundException) {
$status = 404;
$template = '404.php'; // page d'erreur dédiée
$data = ['pagetitle' => 'Page introuvable'];
}
// Si on est en mode développement, afficher le message exact de l'erreur
elseif ($displayErrorDetails) {
$data['message'] = $exception->getMessage();
}
// Rend la page d'erreur correspondante avec le bon statut HTTP
return $this->view->render($response->withStatus($status), $template, $data);
}
}
