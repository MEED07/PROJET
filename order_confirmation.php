<?php
include "include/nav.php";
include "include/db.php";

// Check if order ID is provided
if (!isset($_GET['order_id'])) {
    header('Location: index.php');
    exit;
}

$orderId = intval($_GET['order_id']);

// Retrieve order details
$stmt = $pdo->prepare("SELECT c.id, c.total, c.date_creation, u.login AS client_name FROM commande c JOIN utilisateur u ON c.id_client = u.id WHERE c.id = ?");
$stmt->execute([$orderId]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    echo "<h1>Order not found</h1>";
    exit;
}

// Retrieve order lines
$stmt = $pdo->prepare("SELECT p.libelle, lc.prix, lc.quantite, lc.total FROM ligne_commande lc JOIN produit p ON lc.id_produit = p.id WHERE lc.id_commande = ?");
$stmt->execute([$orderId]);
$orderLines = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="style/order_confirmation.css">
    <script defer src="dark-mode.js"></script>
</head>
<body>
    <div class="confirmation-container">
        <h1>Thank you for your order!</h1>
        <p>Your order has been successfully placed. Below are the details of your purchase.</p>

        <div class="order-summary">
            <h2>Order Details</h2>
            <p><strong>Order ID:</strong> <?= htmlspecialchars($order['id']) ?></p>
            <p><strong>Client Name:</strong> <?= htmlspecialchars($order['client_name']) ?></p>
            <p><strong>Order Date:</strong> <?= htmlspecialchars($order['date_creation']) ?></p>
            <p><strong>Total Amount:</strong> $<?= number_format($order['total'], 2) ?></p>
        </div>

        <div class="order-items">
            <h2>Items Ordered</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php foreach ($orderLines as $line): ?>
                        <tr>
                            <td><?= htmlspecialchars($line['libelle']) ?></td>
                            <td>$<?= number_format($line['prix'], 2) ?></td>
                            <td><?= htmlspecialchars($line['quantite']) ?></td>
                            <td>$<?= number_format($line['total'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="confirmation-actions">
            <a href="commande.php" class="btn">Continue Shopping</a>
        </div>
    </div>
</body>
<style>
        body.dark-mode {
    background-color: #121212;
    
}
.dark-mode .confirmation-container {
    background-color:rgb(190, 184, 184);
    
}


</style>
</html>
