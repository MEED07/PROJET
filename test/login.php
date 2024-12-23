<?php
require_once('include/db.php'); // Connexion à la base de données

if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Requête pour vérifier l'utilisateur
    $query = "SELECT * FROM utilisateur WHERE login = :login";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['login' => $login]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Utilisateur authentifié
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['login'] = $user['login'];
        header('Location: index.php'); // Rediriger vers la page d'accueil
        exit();
    } else {
        // Erreur d'authentification
        echo 'Nom d\'utilisateur ou mot de passe incorrect.';
    }
}
?>

<!-- Formulaire de connexion -->
<form action="login.php" method="POST">
    <input type="text" name="login" placeholder="Nom d'utilisateur" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
</form>
