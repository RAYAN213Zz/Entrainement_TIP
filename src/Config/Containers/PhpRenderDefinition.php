<?php



declare(strict_types=1);
namespace App\Config\Containers;
use DI\ContainerBuilder;
use Slim\Views\PhpRenderer;

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../php-error.log');
/**
* Classe de configuration du moteur de rendu des vues (PhpRenderer).
*
* Cette classe ajoute au conteneur de dépendances (DI Container)
* la définition du service PhpRenderer, utilisé pour afficher les vues HTML.
*
* PhpRenderer permet de :
* - Définir le répertoire racine des fichiers de vues (.php)
* - Spécifier un layout global commun à toutes les pages
* - Ajouter des variables globales accessibles dans toutes les vues
*/
class PhpRenderDefinition
{
/**
* Méthode d'invocation appelée pour enregistrer les définitions
* dans le conteneur de dépendances.
*
* @param ContainerBuilder $containerBuilder
* Instance du constructeur du conteneur DI.
*/
public function __invoke(ContainerBuilder $containerBuilder): void
{
// --- Enregistrement du moteur de rendu PhpRenderer ---
$containerBuilder->addDefinitions([
// --- Définition du service PhpRenderer ---
// PhpRenderer est un moteur de template simple basé sur PHP natif.
// Il gère :
// - L'affichage des vues (fichiers .php)
// - L'intégration d'un layout commun
// - Le passage de variables globales à toutes les vues
PhpRenderer::class => static function () {
// Création du moteur de rendu en précisant le dossier des vues
$view = new PhpRenderer(__DIR__ . '/../../../Views');
// Définition du layout global (ex : structure HTML commune)
$view->setLayout('layout.php');
// Ajout de variables globales disponibles dans toutes les vues
$view->addAttribute('appName', 'Nom par défaut'); // nom de l'application
$view->addAttribute('year', date('Y')); // année courante
// Retourne l'instance configurée de PhpRenderer
return $view;
},
]);
}
}