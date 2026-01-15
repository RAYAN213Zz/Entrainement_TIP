<?php
return [
    'dsn' => 'mysql:host=127.0.0.1;dbname=Projet_TPI;charset=utf8mb4',
    'user' => 'root',
    'password' => 'Super',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ],
];