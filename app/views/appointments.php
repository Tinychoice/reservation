<?php
session_start();
require '../../config/config.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Récupération des rendez-vous existants
$stmt = $pdo->prepare("SELECT date_rdv, heure_rdv FROM rendezvous");
$stmt->execute();
$rdvs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require '../app/views/includes/header.php'; ?> <!-- Ajout du header -->


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre un Rendez-vous</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- jQuery & Datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
</head>

<!-- jQuery & Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
$(document).ready(function(){
    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '0d',
        autoclose: true,
        todayHighlight: true,
        daysOfWeekDisabled: [0] // Désactiver le dimanche (facultatif)
    });
});
</script>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Prendre un Rendez-vous</h2>
        <form action="../../app/controllers/book_appointment.php" method="POST">
            <div class="mb-3">
                <label>Date</label>
                <input type="text" id="datepicker" name="date_rdv" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Heure</label>
                <input type="time" name="heure_rdv" class="form-control" required>
            </div>
            <button type="submit" name="book" class="btn btn-success">Réserver</button>
        </form>

        <h3 class="mt-5">Créneaux occupés</h3>
        <ul class="list-group">
            <?php foreach ($rdvs as $rdv): ?>
                <li class="list-group-item">
                    <?= htmlspecialchars($rdv['date_rdv']) ?> à <?= htmlspecialchars($rdv['heure_rdv']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <h3 class="mt-5">Vos rendez-vous</h3>
        <ul class="list-group">
            <?php
            $stmt = $pdo->prepare("SELECT id, date_rdv, heure_rdv FROM rendezvous WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $userRdvs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <?php foreach ($userRdvs as $rdv): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($rdv['date_rdv']) ?> à <?= htmlspecialchars($rdv['heure_rdv']) ?>
                    <form action="../../app/controllers/cancel_appointment.php" method="POST">
                        <input type="hidden" name="rdv_id" value="<?= $rdv['id'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Annuler</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php require '../views/includes/footer.php'; ?>
</body>
</html>


<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
$(document).ready(function(){
    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '0d',
        autoclose: true,
        todayHighlight: true,
        daysOfWeekDisabled: [0] // Désactiver le dimanche (facultatif)
    });
});
</script>


