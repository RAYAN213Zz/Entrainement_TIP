<?php
namespace App\Controllers;

use Exception;
use App\Models\User;
use App\Middlewares\AuthMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;


use PDO;

class UserController
{


    public function __construct(private PhpRenderer $view)
    {

    }


    public function getAllUser(Request $request, Response $response, array $args): Response
    {

       
        $res = User::getAll();



        $data = ["users" => $res];
        return $this->view->render($response, '/users/user.php', $data);

    }

    public function create(Request $request, Response $response, array $args): Response
    {
        return $this->view->render($response, '/users/create.php');
    }

    public function store(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody() ?? [];

        $user = new User(
            null,
            $data['nom'] ?? '',
            $data['email'] ?? '',
            password_hash($data['password'] ?? '', PASSWORD_BCRYPT),
            $data['role_id'] ?? 3
        );

        $user->createUser();

        return $response->withHeader('Location', '/users')->withStatus(302);
    }

    public function edit(Request $request, Response $response, array $args): Response
    {
        $id = (int) ($args['id'] ?? 0);
        $user = User::findById($id);

        if (!$user) {
            return $response->withHeader('Location', '/users')->withStatus(302);
        }

        return $this->view->render($response, '/auth/update.php', ['user' => $user]);
    }

    public function update(Request $request, Response $response, array $args): Response
    {
        $id = (int) ($args['id'] ?? 0);
        $data = $request->getParsedBody() ?? [];

        $payload = [
            'nom' => trim($data['nom'] ?? ''),
            'email' => trim($data['email'] ?? ''),
            'role_id' => (int) ($data['role_id'] ?? 3),
        ];

        $password = trim($data['password'] ?? '');
        if ($password !== '') {
            $payload['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        User::updateById($id, $payload);

        return $response->withHeader('Location', '/users')->withStatus(302);
    }





}

?>
