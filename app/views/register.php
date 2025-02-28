<?php require '../../config/config.php'; ?>

<?php require '../views/includes/header.php'; ?>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Inscription</h2>
        <form action="../../app/controllers/register.php" method="POST">
            <div class="mb-3">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Prénom</label>
                <input type="text" name="prenom" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Date de naissance</label>
                <input type="date" name="date_naissance" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Adresse</label>
                <input type="text" name="adresse" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Téléphone</label>
                <input type="tel" name="telephone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>
</body>
</html>
