<?php
declare(strict_types=1);
namespace App\Config\Containers;
use DI\ContainerBuilder;
use PDO;

final class DatabaseDefinition
{
    
public function __invoke(ContainerBuilder $builder): void
{
$builder->addDefinitions([
PDO::class => static function () {
$cfg = require __DIR__ . '/../db.php';
return new PDO(
$cfg['dsn'],
$cfg['user'],
$cfg['password'],
$cfg['options'] ?? []
);
},
]);
}
}