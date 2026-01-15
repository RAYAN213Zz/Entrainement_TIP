<?php
declare(strict_types=1);
namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
final class HomeController
{
public function __construct(private PhpRenderer $view)
{
}
public function __invoke(Request $request, Response $response): Response
{
// Le layout est appliqué automatiquement (setLayout dans la config)
return $this->view->render($response, 'home.php', [
'pagetitle' => 'Accueil', // lu par layout.php
'title' => "Page d'accueil", // utilisé par home.php si besoin
'message' => "Bienvenue sur notre page d'accueil !",
]);
}
}

