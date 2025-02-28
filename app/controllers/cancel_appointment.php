<?php
session_start();
require '../../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rdv_id'])) {
    $rdv_id = $_POST['rdv_id'];
    $user_id = $_SESSION['user_id'];

    // Vérifier que le rendez-vous appartient bien à l'utilisateur
    $stmt = $pdo->prepare("DELETE FROM rendezvous WHERE id = ? AND user_id = ?");
    $stmt->execute([$rdv_id, $user_id]);

    header("Location: ../../app/views/appointments.php");
    exit;
}
?>

