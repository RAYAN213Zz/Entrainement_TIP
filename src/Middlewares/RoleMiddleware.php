<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Psr7\Response as SlimResponse;

class RoleMiddleware
{
    public function __construct(private array $roles) {}

    public function __invoke(Request $request, Handler $handler): Response
    {
        // User not in session: redirect to login.
        if (!isset($_SESSION['user'])) {
            return $this->redirect('/login');
        }

        // User logged in but role not allowed: return 403 with a message.
        if (!in_array($_SESSION['user']['role'], $this->roles, true)) {
            return $this->forbidden('Accès interdit<br><a href="/">Retour</a>');
        }

        // Authorized: continue the request pipeline.
        return $handler->handle($request);
    }

    // Build a 302 redirect response.
    private function redirect(string $path): Response
    {
        return (new SlimResponse())
            ->withHeader('Location', $path)
            ->withStatus(302);
    }

    // Build a 403 response and write the provided HTML message.
    private function forbidden(string $message): Response
    {
        $response = new SlimResponse();
        $response->getBody()->write($message);

        return $response->withStatus(403);
    }
}
