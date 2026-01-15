<?php
declare(strict_types=1);
namespace App\Config\Containers;
use DI\ContainerBuilder;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Factory\AppFactory;
class HttpDefinition
{
public function __invoke(ContainerBuilder $containerBuilder): void
{
$containerBuilder->addDefinitions([
// ResponseFactory (utile pour l'ErrorHandler)
ResponseFactoryInterface::class => static fn () => AppFactory::determineResponseFactory(),
]);
}
}