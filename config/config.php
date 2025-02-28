<?php
// Paramètres de connexion
$host = 'localhost';
$dbname = 'reservation';
$username = 'root'; // Par défaut sous XAMPP
$password = ''; // Pas de mot de passe sous XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
