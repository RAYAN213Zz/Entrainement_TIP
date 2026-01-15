<?php

namespace App\Controllers;

use App\Models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class AuthController
{
    public function __construct(private PhpRenderer $view) {}

    // Affiche le formulaire de login
    public function loginForm(Request $request, Response $response, array $args): Response
    {
        
        return $this->view->render($response, '/auth/login.php', ['error' => null]);
    }
    public function renderUpdate(Request $request, Response $response, array $args): Response
    {
        
        return $this->view->render($response, '/auth/update.php', ['error' => null]);
    }

    
    // Traite le login
    public function login(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        $email = trim($data['email']);
        $password = $data['password'];

        $user = User::findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return $this->view->render($response, '/auth/login.php', [
                'error' => "Email ou mot de passe incorrect"
            ]);
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'nom' => $user['nom'],
            'email' => $user['email'],
            'role_id' => $user['role_id'],
            'role' => $user['nom_role'], // admin / moderateur / user
        ];

        return $response->withHeader('Location', '/users')->withStatus(302);
    }

    // Logout
    public function logout(Request $request, Response $response, array $args): Response
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SESSION['user']);
       

        return $response->withHeader('Location', '/login')->withStatus(302);
    }
}
