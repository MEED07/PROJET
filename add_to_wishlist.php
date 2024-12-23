<?php
session_start();
include "include/db.php";

// Response array
$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is logged in
    if (!isset($_SESSION['login'])) {
        $response['message'] = 'Please log in to add items to wishlist.';
        echo json_encode($response);
        exit;
    }

    // Get the product ID
    $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

    if ($productId > 0) {
        try {
            // Check if product exists
            $stmt = $pdo->prepare("SELECT * FROM produit WHERE id = ?");
            $stmt->execute([$productId]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                // Check if product is already in wishlist
                if (!isset($_SESSION['wishlist'])) {
                    $_SESSION['wishlist'] = [];
                }

                // Add to wishlist if not already present
                if (!in_array($productId, $_SESSION['wishlist'])) {
                    $_SESSION['wishlist'][] = $productId;
                    $response['success'] = true;
                    $response['message'] = 'Product added to wishlist.';
                } else {
                    $response['message'] = 'Product already in wishlist.';
                }
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