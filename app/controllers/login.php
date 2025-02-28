<?php
session_start();
require '../../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Vérifier si l'email existe
    $stmt = $pdo->prepare("SELECT id, nom, prenom, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie, on stocke l'utilisateur en session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['prenom'] . ' ' . $user['nom'];

        header("Location: ../../public/index.php");
        exit;
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>
