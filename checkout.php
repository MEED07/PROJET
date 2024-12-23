<?php
include "include/nav.php";
include "include/db.php";

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}


if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    header('Location: panier.php');
    exit;
}


function getProductDetails($pdo, $productId) {
    $stmt = $pdo->prepare("SELECT * FROM produit WHERE id = ?");
    $stmt->execute([$productId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


$stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE login = ?");
$stmt->execute([$_SESSION['login']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);


$total = 0;
$cartProducts = [];
foreach ($_SESSION['panier'] as $productId => $quantity) {
    $product = getProductDetails($pdo, $productId);
    if ($product) {
        $product['quantity'] = $quantity;
        $product['subtotal'] = $product['prix'] * $quantity;
        $cartProducts[] = $product;
        $total += $product['subtotal'];
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_order'])) {
    $address = $_POST['address'] ?? '';
    $paymentMethod = $_POST['payment_method'] ?? 'credit_card';

    try {
        
        $pdo->beginTransaction();

        
        $tax = $total * 0.1;
        $grandTotal = $total + $tax;
        $stmt = $pdo->prepare("INSERT INTO commande (id_client, total, valide) VALUES (?, ?, 0)");
        $stmt->execute([$user['id'], $grandTotal]);
        $orderId = $pdo->lastInsertId();

        
        $lineStmt = $pdo->prepare("INSERT INTO ligne_commande (id_produit, id_commande, prix, quantite, total) VALUES (?, ?, ?, ?, ?)");
        foreach ($cartProducts as $product) {
            $lineStmt->execute([
                $product['id'], 
                $orderId, 
                $product['prix'], 
                $product['quantity'], 
                $product['subtotal']
            ]);
        }

        
        $pdo->commit();

        
        unset($_SESSION['panier']);

        
        header('Location: order_confirmation.php?order_id=' . $orderId);
        exit;

    } catch (Exception $e) {
        
        $pdo->rollBack();
        $error = "Order processing failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style/checkout.css">
    <script defer src="dark-mode.js"></script>
    <script src="https://kit.fontawesome.com/c1df782baf.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="checkout-container">
        <h1>Checkout</h1>

        <?php if (!empty($error)): ?>
            <div class="error-message">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="shipping-details">
                <h2>Shipping Information</h2>
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['login']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Shipping Address</label>
                    <textarea id="address" name="address" required></textarea>
                </div>

                <h2>Payment Method</h2>
                <div class="payment-methods">
                    <label>
                        <input type="radio" name="payment_method" value="credit_card" checked>
                        <i class="fas fa-credit-card"></i> Credit Card
                    </label>
                    <label>
                        <input type="radio" name="payment_method" value="paypal">
                        <i class="fab fa-paypal"></i> PayPal
                    </label>
                </div>
            </div>

            <div class="order-summary">
                <h2>Order Summary</h2>
                <?php foreach ($cartProducts as $product): ?>
                    <div class="summary-item">
                        <span><?= htmlspecialchars($product['libelle']) ?></span>
                        <span>x<?= $product['quantity'] ?></span>
                        <span>$<?= number_format($product['subtotal'], 2) ?></span>
                    </div>
                <?php endforeach; ?>

                <div class="summary-totals">
                    <div class="summary-item">
                        <span>Subtotal</span>
                        <span>$<?= number_format($total, 2) ?></span>
                    </div>
                    <div class="summary-item">
                        <span>Tax (10%)</span>
                        <span>$<?= number_format($total * 0.1, 2) ?></span>
                    </div>
                    <div class="summary-item total">
                        <span>Total</span>
                        <span>$<?= number_format($total * 1.1, 2) ?></span>
                    </div>
                </div>
            </div>

            <input type="submit" name="submit_order" class="btn btn-place-order" value="Place Order">
        </form>
    </div>
</body>
<style>
    body.dark-mode {
    background-color: #121212;
    
}
.dark-mode .checkout-container {
    background-color: #333333;  
}
.dark-mode .checkout-container h1 {
    color:rgb(255, 255, 255);
    
}
.dark-mode .checkout-container form div {
    background-color:rgb(190, 184, 184);  
}
</style>
</html>
