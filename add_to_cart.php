<?php
session_start();
include "include/db.php";

// Response array
$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is logged in
    if (!isset($_SESSION['login'])) {
        $response['message'] = 'Please log in to add items to cart.';
        echo json_encode($response);
        exit;
    }

    // Get the product ID and quantity
    $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if ($productId > 0) {
        try {
            // Check if product exists
            $stmt = $pdo->prepare("SELECT * FROM produit WHERE id = ?");
            $stmt->execute([$productId]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                // Initialize cart if not exists
                if (!isset($_SESSION['panier'])) {
                    $_SESSION['panier'] = [];
                }

                // Add to cart or update quantity
                if (isset($_SESSION['panier'][$productId])) {
                    $_SESSION['panier'][$productId] += $quantity;
                } else {
                    $_SESSION['panier'][$productId] = $quantity;
                }

                $response['success'] = true;
                $response['message'] = 'Product added to cart.';
                $response['cart_count'] = array_sum($_SESSION['panier']);
            } else {
                $response['message'] = 'Invalid product.';
            }
        } catch (PDOException $e) {
            $response['message'] = 'Database error: ' . $e->getMessage();
        }
    } else {
        $response['message'] = 'Invalid product ID.';
    }
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit;