<?php
session_start();
require_once 'include/db.php';

$error = ""; // Initialize error message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    try {
        $query = "SELECT * FROM utilisateur WHERE login = :login";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':login' => $login]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) { // Comparaison directe des mots de passe (INSECURE)
            $_SESSION['login'] = $user['login'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header('Location: admin.php');
            } else {
                header('Location: index.php');
            }
            exit;
        } else {
            $error = "Login ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        $error = "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 800px;
            max-width: 90%;
            height: 60%;
            max-height: 60%;
        }

        .image-section {
            flex: 1;
            background: url('images/APPLE-EVENT-SEP-2023-WALLPAPER-mod1.jpg') no-repeat center center/cover;
        }

        .form-section {
            flex: 1;
            padding: 20px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        form {
            width: 100%;
        }

        form h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        form input[type="text"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: center;
        }

        form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #0056b3;
        }

        form p {
            margin-top: 10px;
            font-size: 14px;
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="image-section"></div>
    <div class="form-section">
        <form method="POST" action="">
            <h2>Se connecter</h2>
            <input type="text" name="login" placeholder="Login" required value="<?= isset($_POST['login']) ? htmlspecialchars($_POST['login']) : '' ?>">
            <input type="password" name="password" placeholder="Password" required>
            <?php if (!empty($error)) : ?>
                <div class="error-message"><?= $error ?></div>
            <?php endif; ?>
            <button type="submit">Se connecter</button>
            <p><a href="register.php">S'inscrire</a></p>
            <p><a href="Forgot_Password.php">Mot de passe oublié ?</a></p>
        </form>
    </div>
</div>
</body>
</html>
