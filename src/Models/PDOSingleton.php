<?php
namespace App\Models;
use PDO;
use PDOException;
/**
 * Classe PDOSingleton
 * -------------------
 * Cette classe implémente le pattern "Singleton" pour la connexion PDO.
 *
 * Objectif :
 * - Ne créer qu'une seule instance de PDO pour toute l'application,
 * - Réutiliser cette instance partout où l'on a besoin d'accéder à la base de données.
 */
class PDOSingleton
{
    /**
     * Instance unique de PDOSingleton.
     *
     * @var PDOSingleton|null
     */
    private static $instance = null; // Stocke l'instance unique de la classe
    /**
     * Connexion PDO sous-jacente.
     *
     * @var PDO
     */
    private $pdo;
    private $host = 'localhost';
    private $db = 'Projet_TPI'; // Nom de la base de données
    private $user = 'root'; // Nom d'utilisateur MySQL
    private $pass = 'Super'; // Mot de passe MySQL
    private $charset = 'utf8mb4';

    private function __construct()
    {
        // DSN (Data Source Name) pour une base MySQL.
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        // Options de configuration pour PDO.
        $options = [
                // Les erreurs PDO généreront des exceptions (plus simple à gérer proprement).
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                // Les résultats seront renvoyés sous forme de tableaux associatifs par défaut.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                // Désactive l'émulation des requêtes préparées pour utiliser les vraies requêtes préparées MySQL.
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            // Création de l'instance PDO avec DSN, utilisateur, mot de passe et options.
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, on relance l'exception.
        // Dans une vraie appli, on pourrait loguer l'erreur et afficher une page 500 propre.
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
    /**
     * Empêche la duplication d'instances par clonage.
     */
    private function __clone()
    {
        // Méthode vide mais privée : interdit le clonage de l'instance singleton.
    }
    /**
     * Empêche la désérialisation de l'instance.
     */
    public function __wakeup()
    {
        // Laisser cette méthode vide (et idéalement la rendre private) pour empêcher unserialize().
    }
    /**
     * Méthode d'accès à l'instance unique (Singleton).
     *
     * Si aucune instance n'existe encore, on en crée une.
     * Sinon, on retourne l'instance déjà existante.
     *
     * @return PDOSingleton
     */
    public static function getInstance(): PDOSingleton
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    /**
     * Retourne l'objet PDO pour exécuter des requêtes SQL.
     *
     * Exemple d'utilisation :
     * $pdo = PDOSingleton::getInstance()->getConnection();
     * $stmt = $pdo->prepare('SELECT * FROM users');
     *
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}