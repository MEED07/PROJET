<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <style>
        .admin-nav ul {
    list-style: none;
    display: flex;
    gap: 10px;
    background-color: #333;
    padding: 10px;
}
.admin-nav ul li a {
    text-decoration: none;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
}
.admin-nav ul li a:hover {
    background-color: #555;
}

    </style>
</head>
<body>
    <header>
        <nav class="admin-nav">
            <ul>
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="ajouter_categorie.php">Ajouter Categorie</a></li>
                <li><a href="ajouter_produit.php">Ajouter Produit</a></li>
                <li><a href="commande.php">Gérer Commandes</a></li>
                <li><a href="index.php" target="_blank">Voir le site</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Bienvenue dans l'administration</h1>
        
    </main>

    <footer>
        <p>&copy; 2024 - </p>
    </footer>
</body>
</html>
