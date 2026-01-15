<?php
declare(strict_types=1);
namespace App\Routes;
use App\Controllers\HomeController;
use App\Controllers\UserController;

use App\Middlewares\RoleMiddleware;

use Slim\App;
use Slim\Views\PhpRenderer;
use App\Controllers\AuthController;

final class Web
{
    public static function register(App $app, PhpRenderer $view): void
    {

        $app->get('/', [HomeController::class, '__invoke'])->setName('home');
        $app->get('/users/create', [UserController::class, 'create']); // affiche formulaire
        $app->post('/users/store', [UserController::class, 'store']);  // insert en DB
        $app->get('/users',[UserController::class, 'getAllUser'])->add(new RoleMiddleware(['admin','moderateur']));
   

        $app->get('/login', [AuthController::class, 'loginForm']);
        $app->post('/login', [AuthController::class, 'login']);
        $app->get('/logout', [AuthController::class, 'logout']);



    }
}



