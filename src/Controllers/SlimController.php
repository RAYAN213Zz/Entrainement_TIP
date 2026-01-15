<?php
namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;



class SlimController
{

    public function home(Request $request, Response $response, array $args): Response
    {
        // Construire la structure de la page
        $dataLayout = ['title' => 'Slime'];
        $phpView = new PhpRenderer(__DIR__ . '/../Views', $dataLayout); 
        $phpView->setLayout("layout.php");
        // Construire le contenu de la page
        $dataDetail = ['id' => $args['id']];

        // Générer le rendu
        return $phpView->render($response, 'home.php', $dataDetail);
}

       
}

