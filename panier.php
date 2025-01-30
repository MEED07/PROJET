<?php

include "include/nav.php";
include "include/db.php";

// Check if user is logged in
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

// Initialize cart in session if not exists
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Function to get product details
function getProductDetails($pdo, $productId) {
    $stmt = $pdo->prepare("SELECT * FROM produit WHERE id = ?");
    $stmt->execute([$productId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Handle quantity updates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_quantity'])) {
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        
        // Update quantity in session
        if (isset($_SESSION['panier'][$productId])) {
            $_SESSION['panier'][$productId] = $quantity;
        }
    }

    // Handle product removal
    if (isset($_POST['remove_product'])) {
        $productId = $_POST['product_id'];
        unset($_SESSION['panier'][$productId]);
    }
}

// Calculate total
$total = 0;
$cartProducts = [];

if (!empty($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $productId => $quantity) {
        $product = getProductDetails($pdo, $productId);
        if ($product) {
            $product['quantity'] = $quantity;
            $product['subtotal'] = $product['prix'] * $quantity;
            $cartProducts[] = $product;
            $total += $product['subtotal'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link rel="stylesheet" href="style/panier.css?v=<?php echo time(); ?>">
    <script defer src="dark-mode.js"></script>
    <script src="https://kit.fontawesome.com/c1df782baf.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="cart-container"  style="margin-top: 5%;">
        <h1>Your Shopping Cart</h1>
        
        <?php if (empty($cartProducts)): ?>
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <p>Your cart is empty</p>
                <a href="phone.php" class="btn btn-primary">Continue Shopping</a>
            </div>
        <?php else: ?>
            <div class="cart-content">
                <div class="cart-items">
                    <?php foreach ($cartProducts as $product): ?>
                        <div class="cart-item">
                            <img src="upload/produit/<?= $product['image']; ?>" alt="<?= $product['libelle']; ?>">
                            <div class="item-details">
                                <h3><?= $product['libelle']; ?></h3>
                                <p class="price">$<?= number_format($product['prix'], 2); ?></p>
                                
                                <form method="POST" class="quantity-form">
                                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                    <div class="quantity-control">
                                        <button type="button" class="qty-btn qty-minus">-</button>
                                        <input type="number"  name="quantity" value="<?= $product['quantity']; ?>" 
                                               min="1" class="qty-input">
                                        <button type="button" class="qty-btn qty-plus">+</button>
                                    </div>
                                    <button type="submit" name="update_quantity" class="btn btn-update">Update</button>
                                    
                                    <button type="submit" name="remove_product" class="btn btn-remove">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </form>
                                
                                <p class="subtotal">Subtotal: $<?= number_format($product['subtotal'], 2); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="cart-summary">
                    <h2>Order Summary</h2>
                    <div class="summary-item">
                        <span>Subtotal</span>
                        <span>$<?= number_format($total, 2); ?></span>
                    </div>
                    <div class="summary-item">
                        <span>Tax (10%)</span>
                        <span>$<?= number_format($total * 0.1, 2); ?></span>
                    </div>
                    <div class="summary-item total">
                        <span>Total</span>
                        <span>$<?= number_format($total * 1.1, 2); ?></span>
                    </div>
                    <a href="checkout.php" class="btn btn-checkout">Proceed to Checkout</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
   
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity control logic
        document.querySelectorAll('.quantity-control').forEach(control => {
            const minusBtn = control.querySelector('.qty-minus');
            const plusBtn = control.querySelector('.qty-plus');
            const qtyInput = control.querySelector('.qty-input');

            minusBtn.addEventListener('click', () => {
                if (qtyInput.value > 1) {
                    qtyInput.value = parseInt(qtyInput.value) - 1;
                }
            });

            plusBtn.addEventListener('click', () => {
                qtyInput.value = parseInt(qtyInput.value) + 1;
            });
        });
    });
    </script>
    <style>
        body.dark-mode {
    background-color: #121212;
   
}
.dark-mode .cart-container {
    background-color: #333333;
    color: #ffffff;
}
.dark-mode .cart-container input {
    background-color: #333333;
    color: #ffffff;
}
.dark-mode .cart-container .cart-summary {
    background-color: #333333;
    
}
    </style>
</body>
</html>