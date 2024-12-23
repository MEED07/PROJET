<?php

include "include/nav.php";
include "include/db.php";

// Check if user is logged in
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

// Get wishlist product details
$wishlist_products = [];
if (isset($_SESSION['wishlist']) && !empty($_SESSION['wishlist'])) {
    $wishlist_ids = implode(',', array_map('intval', $_SESSION['wishlist']));
    $stmt = $pdo->prepare("SELECT * FROM produit WHERE id IN ($wishlist_ids)");
    $stmt->execute();
    $wishlist_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Remove from wishlist handler
if (isset($_GET['remove']) && is_numeric($_GET['remove'])) {
    $remove_id = intval($_GET['remove']);
    if (($key = array_search($remove_id, $_SESSION['wishlist'])) !== false) {
        unset($_SESSION['wishlist'][$key]);
    }
    header('Location: wishlist.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist</title>
    <link rel="stylesheet" href="style/WISHLIST.css">
    <script defer src="dark-mode.js"></script>
    
</head>
<body>
    <div class="wishlist-container">
        <h1>My Wishlist</h1>
        
        <?php if (empty($wishlist_products)): ?>
            <div class="empty-wishlist">
                <p>Your wishlist is empty.</p>
                <a href="phone.php" class="btn">Browse Products</a>
            </div>
        <?php else: ?>
            <table class="wishlist-table">
                <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($wishlist_products as $product): ?>
                        <tr>
                            <td>
                                <img src="upload/produit/<?= $product['image']; ?>" alt="<?= $product['libelle']; ?>">
                            </td>
                            <td><?= $product['libelle']; ?></td>
                            <td>$<?= number_format($product['prix'], 2); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-add-cart">
                                        <i class="fas fa-shopping-cart"></i> Add to Cart
                                    </button>
                                    <a href="wishlist.php?remove=<?= $product['id']; ?>" class="btn btn-remove">
                                        <i class="fas fa-trash"></i> Remove
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <style>
body.dark-mode {
background-color: #121212;

}
.dark-mode .wishlist-container {
background-color: #333333;
color: #ffffff;
}
.dark-mode .wishlist-container h1 {

color: #ffffff;
}
    </style>
</body>
</html>