<?php
declare(strict_types=1);
namespace App\Config\Containers;
use App\Middlewares\ErrorHandler;
use DI\ContainerBuilder;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Views\PhpRenderer;
class ErrorDefinition
{
public function __invoke(ContainerBuilder $containerBuilder): void
{
$containerBuilder->addDefinitions([
ErrorHandler::class => static function ($c) {
return new ErrorHandler(

$c->get(ResponseFactoryInterface::class),
$c->get(PhpRenderer::class)
);
},
]);
}
}