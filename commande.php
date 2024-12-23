<?php
include "include/nav.php";
include "include/db.php";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

// Obtenir les détails de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE login = ?");
$stmt->execute([$_SESSION['login']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'utilisateur existe
if (!$user) {
    echo "Erreur : utilisateur non trouvé.";
    exit;
}

// Vérifier si l'utilisateur est un administrateur
$isAdmin = ($user['role'] === 'admin');

// Récupérer les commandes
if ($isAdmin) {
    // L'admin voit toutes les commandes
    $stmt = $pdo->query("
        SELECT 
            c.id, 
            c.total, 
            c.valide, 
            c.date_creation, 
            u.login as client_name, 
            c.id_client
        FROM commande c
        JOIN utilisateur u ON c.id_client = u.id
        ORDER BY c.date_creation DESC
    ");
} else {
    // L'utilisateur voit seulement ses propres commandes
    $stmt = $pdo->prepare("
        SELECT 
            c.id, 
            c.total, 
            c.valide, 
            c.date_creation, 
            c.id_client
        FROM commande c
        WHERE c.id_client = ?
        ORDER BY c.date_creation DESC
    ");
    $stmt->execute([$user['id']]);
}

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vérification de l'absence de commandes
if (empty($orders)) {
    echo "Aucune commande trouvée.";
}

// Traiter la mise à jour du statut (pour l'administrateur)
if ($isAdmin && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_status'])) {
        $orderId = $_POST['order_id'];
        $newStatus = $_POST['status'];

        // Mettre à jour le statut de la commande
        $updateStmt = $pdo->prepare("UPDATE commande SET valide = ? WHERE id = ?");
        $updateStmt->execute([$newStatus, $orderId]);

        // Rafraîchir la liste des commandes après mise à jour
        $stmt = $pdo->query("
            SELECT 
                c.id, 
                c.total, 
                c.valide, 
                c.date_creation, 
                u.login as client_name, 
                c.id_client
            FROM commande c
            JOIN utilisateur u ON c.id_client = u.id
            ORDER BY c.date_creation DESC
        ");
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Fonction pour récupérer les détails de la commande
function getOrderDetails($pdo, $orderId) {
    $stmt = $pdo->prepare("
        SELECT 
            lc.id, 
            p.libelle, 
            p.image, 
            lc.prix, 
            lc.quantite, 
            lc.total
        FROM ligne_commande lc
        JOIN produit p ON lc.id_produit = p.id
        WHERE lc.id_commande = ?
    ");
    $stmt->execute([$orderId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="style/commande.css">
    <script defer src="dark-mode.js"></script>
    <script src="https://kit.fontawesome.com/c1df782baf.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="orders-container">
        <h1><?= $isAdmin ? 'All Orders' : 'My Orders' ?></h1>

        <?php if (empty($orders)): ?>
            <div class="no-orders">
                <i class="fas fa-shopping-bag"></i>
                <p>No orders found</p>
                <?php if (!$isAdmin): ?>
                    <a href="phone.php" class="btn btn-primary">Continue Shopping</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="orders-list">
                <?php foreach ($orders as $order): ?>
                    <div class="order-card">
                        <div class="order-header">
                            <span class="order-id">Order #<?= $order['id'] ?></span>
                            <?php if ($isAdmin): ?>
                                <span class="client-name">Client: <?= htmlspecialchars($order['client_name']) ?></span>
                            <?php endif; ?>
                            <span class="order-date">
                                <?= date('F d, Y H:i', strtotime($order['date_creation'])) ?>
                            </span>
                        </div>

                        <div class="order-details">
                            <div class="order-items">
                                <?php 
                                $orderDetails = getOrderDetails($pdo, $order['id']);
                                foreach ($orderDetails as $item): 
                                ?>
                                    <div class="order-item">
                                        <img src="upload/produit/<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['libelle']) ?>">
                                        <div class="item-info">
                                            <span class="item-name"><?= htmlspecialchars($item['libelle']) ?></span>
                                            <span class="item-quantity">Qty: <?= $item['quantite'] ?></span>
                                            <span class="item-price">$<?= number_format($item['prix'], 2) ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="order-summary">
                                <div class="summary-item">
                                    <span>Total</span>
                                    <span>$<?= number_format($order['total'], 2) ?></span>
                                </div>
                                <div class="summary-item status">
                                    <span>Status</span>
                                    <?php if ($isAdmin): ?>
                                        <form method="POST" class="status-form">
                                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                            <select name="status" class="status-select">
                                                <option value="0" <?= $order['valide'] == 0 ? 'selected' : '' ?>>Pending</option>
                                                <option value="1" <?= $order['valide'] == 1 ? 'selected' : '' ?>>Processed</option>
                                                <option value="2" <?= $order['valide'] == 2 ? 'selected' : '' ?>>Shipped</option>
                                                <option value="3" <?= $order['valide'] == 3 ? 'selected' : '' ?>>Delivered</option>
                                            </select>
                                            <button type="submit" name="update_status" class="btn btn-update">Update</button>
                                        </form>
                                    <?php else: ?>
                                        <span class="status-badge status-<?= $order['valide'] ?>">
                                            <?php 
                                            switch ($order['valide']) {
                                                case 0: echo 'Pending'; break;
                                                case 1: echo 'Processed'; break;
                                                case 2: echo 'Shipped'; break;
                                                case 3: echo 'Delivered'; break;
                                                default: echo 'Unknown';
                                            }
                                            ?>
                                        </span>
                                    <?php endif; ?>

                                    <!-- Button de suppression pour admin et utilisateur -->
                                    <?php if ($isAdmin || $user['id'] === $order['id_client']): ?>
                                        <form method="POST" action="delete_commande.php" class="delete-form">
                                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                            <button type="submit" name="delete_order" class="btn btn-delete">Delete</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Statut de mise à jour de la commande
        const statusForms = document.querySelectorAll('.status-form');
        statusForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                // Vous pouvez ajouter une validation côté client ici si nécessaire
            });
        });
    });
    </script>
    <style>
body.dark-mode {
background-color: #121212;

}
.dark-mode .orders-container {
background-color: #333333;

}
.dark-mode .orders-container h1 {
color:rgb(247, 242, 242);

}
.dark-mode .orders-container .order-card {
background-color: #333333;
}
.dark-mode .orders-container .order-item span {
color:rgb(247, 242, 242);
}

    </style>
</body>
</html>
