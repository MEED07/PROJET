<?php

require_once 'include/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password']; 
    $role = 'user'; 

    try {
        $query = "INSERT INTO utilisateur (login, password, role) VALUES (:login, :password, :role)";
        $stmt = $pdo->prepare($query);

        
        if ($stmt->execute([':login' => $login, ':password' => $password, ':role' => $role])) {
            echo "Inscription réussie.";
            header('Location: login.php');
            exit;
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        background: url('images/Remove-bg.ai_1706111640891.png') no-repeat center center/cover;
        background-color:black;
    
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
        <div class="image-section">
          
        </div>
        <div class="form-section">
            <form method="POST" action="">
            <h2>Registerer</h2>
            Login: <input type="text" name="login" required><br>
            Password: <input type="password" name="password" required><br>
            <button type="submit">S'inscrire</button><br>
            <a href="login.php">login</a>
            </form>
        </div>
    </div>
</body>
</html>

