<?php
session_start();
require '../../config/config.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../public/login.php");
    exit;
}

// Récupérer les infos de l'utilisateur
$stmt = $pdo->prepare("SELECT nom, prenom, email FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Utilisateur introuvable.");
}
?>

<?php require '../includes/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">Mon Profil</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Nom :</strong> <?= htmlspecialchars($user['nom']) ?></p>
            <p><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>

            <form action="../controllers/delete_account.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?');">
                <button type="submit" name="delete_account" class="btn btn-danger">Supprimer mon compte</button>
            </form>
        </div>
    </div>
</div>
