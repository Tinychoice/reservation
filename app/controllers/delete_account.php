<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../public/index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    $pdo->beginTransaction();

    // Supprimer tous les rendez-vous de l'utilisateur
    $stmt = $pdo->prepare("DELETE FROM rendezvous WHERE user_id = ?");
    $stmt->execute([$user_id]);

    // Supprimer l'utilisateur de la base de données
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$user_id]);

    $pdo->commit();

    // Détruire la session et rediriger vers l'accueil
    session_destroy();
    header("Location: ../../public/index.php");
    exit;
} catch (Exception $e) {
    $pdo->rollBack();
    die("Erreur lors de la suppression du compte : " . $e->getMessage());
}