<?php
declare(strict_types=1);
session_start();


use App\Config\Containers\ComponentDefinition;
use App\Config\Containers\ErrorDefinition;
use App\Config\Containers\HttpDefinition;
use App\Config\Containers\MiddlewareDefinition;
use App\Config\Containers\PhpRenderDefinition;
use App\Middlewares\ErrorHandler;
use App\Middlewares\SessionMiddleware;
use App\Middlewares\ViewGlobalsMiddleware;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;


require __DIR__ . '/../vendor/autoload.php';
$containerBuilder = new ContainerBuilder();
(new App\Config\Containers\DatabaseDefinition())($containerBuilder);

// Enregistre chaque groupe de définitions
(new PhpRenderDefinition())($containerBuilder); // PhpRenderer + globals
(new HttpDefinition())($containerBuilder); // ResponseFactoryInterface
(new ErrorDefinition())($containerBuilder); // ErrorHandler
$container = $containerBuilder->build();
$app = AppFactory::createFromContainer($container);
// --- Middlewares globaux ---
$app->add($container->get(ViewGlobalsMiddleware::class));
$app->add($container->get(SessionMiddleware::class));
// --- Routage & erreurs ---
$app->addBodyParsingMiddleware();   
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
// $errorMiddleware->setDefaultErrorHandler($container->get(ErrorHandler::class));
// --- Routes ---
\App\Routes\Web::register($app, $container->get(PhpRenderer::class));
// --- Run ---
$app->run();