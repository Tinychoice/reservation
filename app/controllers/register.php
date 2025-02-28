<?php
require '../../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Récupération des données
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $date_naissance = $_POST['date_naissance'];
    $adresse = htmlspecialchars($_POST['adresse']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Vérification de l'unicité de l'email
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        die("Cet email est déjà utilisé !");
    }

    // Hachage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Génération du token de vérification
    $token = bin2hex(random_bytes(50));

    // Insertion dans la base de données
    $stmt = $pdo->prepare("INSERT INTO users (nom, prenom, date_naissance, adresse, telephone, email, password, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $prenom, $date_naissance, $adresse, $telephone, $email, $hashed_password, $token]);

    echo "Inscription réussie ! Vérifiez votre email pour activer votre compte.";
}
?>
