<?php
// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=ecommerce', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


$stmtProducts = $pdo->query("SELECT COUNT(*) AS total_products FROM produit");
$totalProducts = $stmtProducts->fetch()['total_products'];


$stmtUsers = $pdo->query("SELECT COUNT(*) AS total_users FROM utilisateur");
$totalUsers = $stmtUsers->fetch()['total_users'];


$stmtOrders = $pdo->query("SELECT COUNT(*) AS total_orders FROM commande");
$totalOrders = $stmtOrders->fetch()['total_orders'];


$stmtRevenue = $pdo->query("SELECT SUM(total) AS total_revenue FROM commande WHERE valide = 1");
$totalRevenue = $stmtRevenue->fetch()['total_revenue'] ?? 0;


$stmtRecentProducts = $pdo->query("SELECT libelle, prix, date_creation FROM produit ORDER BY date_creation DESC LIMIT 5");
$recentProducts = $stmtRecentProducts->fetchAll(PDO::FETCH_ASSOC);

$stmtRecentOrders = $pdo->query("SELECT id, total, date_creation FROM commande ORDER BY date_creation DESC LIMIT 5");
$recentOrders = $stmtRecentOrders->fetchAll(PDO::FETCH_ASSOC);


$query = "SELECT c.id AS order_id, c.total, c.date_creation, u.login AS client_name, p.libelle AS product_name
          FROM commande c
          JOIN utilisateur u ON c.id_client = u.id
          JOIN ligne_commande lc ON c.id = lc.id_commande
          JOIN produit p ON lc.id_produit = p.id
          ORDER BY c.date_creation DESC";
$statement = $pdo->prepare($query);
$statement->execute();
$recentOrders = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin: 10px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card h2 {
            margin: 0 0 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
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

<div class="container">
    <h1>Dashboard</h1>

    <div class="card">
        <h2>Statistiques Générales</h2>
        <p><strong>Total Produits :</strong> <?= $totalProducts; ?></p>
        <p><strong>Total Utilisateurs :</strong> <?= $totalUsers; ?></p>
        <p><strong>Total Commandes :</strong> <?= $totalOrders; ?></p>
        <p><strong>Revenu Total :</strong> <?= number_format($totalRevenue, 2, '.', ' '); ?> $</p>
    </div>

    <div class="card">
        <h2>Derniers Produits Ajoutés</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Date d'Ajout</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentProducts as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['libelle']); ?></td>
                        <td><?= number_format($product['prix'], 2, '.', ' '); ?> $</td>
                        <td><?= $product['date_creation']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
    <h2>Dernières Commandes</h2>
    <table>
        <thead>
            <tr>
                
                <th>Nom du Client</th>
                <th>Nom du Produit</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recentOrders as $order): ?>
                <tr>
                    
                    <td><?= $order['client_name']; ?></td>
                    <td><?= $order['product_name']; ?></td>
                    <td><?= number_format($order['total'], 2, '.', ' '); ?> $</td>
                    <td><?= $order['date_creation']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</div>



</body>
</html>
