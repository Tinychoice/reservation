<?php
session_start();
require '../../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book'])) {
    $user_id = $_SESSION['user_id'];
    $date_rdv = $_POST['date_rdv'];
    $heure_rdv = $_POST['heure_rdv'];

    // Vérifier si le créneau est disponible
    $stmt = $pdo->prepare("SELECT id FROM rendezvous WHERE date_rdv = ? AND heure_rdv = ?");
    $stmt->execute([$date_rdv, $heure_rdv]);

    if ($stmt->rowCount() > 0) {
        die("Ce créneau est déjà réservé.");
    }

    // Insérer le rendez-vous
    $stmt = $pdo->prepare("INSERT INTO rendezvous (user_id, date_rdv, heure_rdv) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $date_rdv, $heure_rdv]);

    header("Location: ../../app/views/appointments.php");
    exit;
}
?>
