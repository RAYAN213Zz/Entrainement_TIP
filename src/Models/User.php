<?php

namespace App\Models;

use App\Models\PDOSingleton;
use PDO;

final class User
{
    protected static $table = 'user';


    public $id = null;
    public $nom = "";
    public $email = "";
    public $password = "";
    public $role_id = null;
    public $date_creation = "";
    public function __construct($id = null, $nom = "", $email = "", $password = "", $role_id = null, $date_creation = "")
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role_id;
        $this->date_creation = $date_creation;
    }

    public static function getAll()
    {
        // Requête d'insertion avec paramètres nommés.
        $sql = "
SELECT u.*, r.nom AS nom_role, r.description AS role_description
FROM " . static::$table . " u
INNER JOIN role r ON r.id = u.role_id
";
        // Récupération de l'instance PDO via le singleton.
        $pdo = PDOSingleton::getInstance()->getConnection();
        // Préparation de la requête.
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
     
        public function createUser()
    {

         $sql = "INSERT INTO " . static::$table . " (nom, email, password, role_id, date_creation)
    VALUES (:nom, :email, :password, :role_id, NOW())
    ";

    $pdo = PDOSingleton::getInstance()->getConnection();
    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        'nom' => $this->nom,
        'email' => $this->email,
        'password' => $this->password,
        'role_id' => $this->role_id
    ]);    

    }

    public static function findByEmail(string $email): ?array
{
    $pdo = PDOSingleton::getInstance()->getConnection();

    $sql = "
        SELECT u.*, r.nom AS nom_role
        FROM " . static::$table . " u
        INNER JOIN role r ON r.id = u.role_id
        WHERE u.email = :email
        LIMIT 1
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ?: null;
}

    public static function findById(int $id): ?array
    {
        $pdo = PDOSingleton::getInstance()->getConnection();

        $sql = "
            SELECT u.*, r.nom AS nom_role
            FROM " . static::$table . " u
            INNER JOIN role r ON r.id = u.role_id
            WHERE u.id = :id
            LIMIT 1
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

   


}
