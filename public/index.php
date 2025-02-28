<?php require '../app/views/includes/header.php'; ?>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Bienvenue sur le système de réservation</h2>
        <p class="text-center">Prenez vos rendez-vous en ligne facilement.</p>

        <?php if (isset($_SESSION['user_name'])): ?>
            <p class="text-center">Bonjour, <?= htmlspecialchars($_SESSION['user_name']) ?> !</p>
            <p class="text-center"><a href="../app/views/appointments.php" class="btn btn-primary">Gérer mes rendez-vous</a></p>
            <p class="text-center"><a href="../app/controllers/logout.php" class="btn btn-danger">Déconnexion</a></p>
        <?php else: ?>
            <p class="text-center"><a href="../app/views/login.php" class="btn btn-primary">Connexion</a></p>
            <p class="text-center"><a href="../app/views/register.php" class="btn btn-secondary">Sign in</a></p>
        <?php endif; ?>
    </div>
</body>
</html>
