<?php
session_start();
require_once 'include/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Étape 1 : Vérification du login
    if (!isset($_POST['new_password'])) {
        $login = $_POST['login'] ?? null;

        if ($login) {
            try {
                $query = "SELECT * FROM utilisateur WHERE login = :login";
                $stmt = $pdo->prepare($query);
                $stmt->execute([':login' => $login]);

                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    $_SESSION['reset_login'] = $login; // Stocker le login en session
                    $message = "Compte trouvé. Vous pouvez maintenant modifier le mot de passe.";
                } else {
                    $error = "Le compte est introuvable.";
                }
            } catch (PDOException $e) {
                $error = "Erreur : " . $e->getMessage();
            }
        } else {
            $error = "Veuillez entrer un login valide.";
        }
    } else {
        // Étape 2 : Mise à jour du mot de passe
        $new_password = $_POST['new_password'] ?? null;

        if ($new_password && isset($_SESSION['reset_login'])) {
            try {
                $query = "UPDATE utilisateur SET password = :password WHERE login = :login";
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    ':password' => $new_password,
                    ':login' => $_SESSION['reset_login']
                ]);

                unset($_SESSION['reset_login']); // Réinitialiser la session
                header("Location: login.php"); // Rediriger vers la page de connexion
                exit;
            } catch (PDOException $e) {
                $error = "Erreur : " . $e->getMessage();
            }
        } else {
            $error = "Veuillez entrer un nouveau mot de passe.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le mot de passe</title>
    <style>
        /* Général */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Conteneur principal */
.container {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    padding: 20px 40px;
    max-width: 400px;
    width: 100%;
}

/* Titres */
h2 {
    text-align: center;
    color: #333333;
    margin-bottom: 20px;
}

/* Formulaires */
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

input[type="text"],
input[type="password"] {
    padding: 10px;
    border: 1px solid #cccccc;
    border-radius: 4px;
    font-size: 16px;
}

input[type="text"]:focus,
input[type="password"]:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Bouton */
button {
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}

/* Messages */
p {
    font-size: 14px;
    text-align: center;
    margin: 0;
}

p[style="color: red;"] {
    color: #e74c3c !important;
}

p[style="color: green;"] {
    color: #27ae60 !important;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <?php if (isset($message)): ?>
                <p style="color: green;"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <?php if (!isset($_SESSION['reset_login'])): ?>
                <!-- Étape 1 : Formulaire pour vérifier le login -->
                <form method="POST" action="">
                    <h2>Modifier le mot de passe</h2>
                    <label for="">Entrez votre login :</label><input type="text" name="login" placeholder="Entrez votre login" required>
                    <button type="submit">Vérifier</button>
                </form>
            <?php else: ?>
                <!-- Étape 2 : Formulaire pour modifier le mot de passe -->
                <form method="POST" action="">
                    <h2>Nouveau mot de passe</h2>
                    <input type="password" name="new_password" placeholder="Entrez votre nouveau mot de passe" required>
                    <button type="submit">Mettre à jour</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
