<?php
session_start();
require '../includes/header.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<div class="container">
    <h2 class="mt-4 text-danger">Supprimer mon compte</h2>
    <p class="text-warning">⚠️ Cette action est irréversible. Toutes vos données seront supprimées.</p>

    <form action="../app/controllers/delete_account.php" method="POST">
        <button type="submit" name="delete" class="btn btn-danger">Confirmer la suppression</button>
        <a href="profile.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>

