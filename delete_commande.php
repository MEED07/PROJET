<?php
include "include/db.php";
session_start();

// Check if user is logged in
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

// Get user details
$stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE login = ?");
$stmt->execute([$_SESSION['login']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user has the right to delete the order
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_order'])) {
    $orderId = $_POST['order_id'];

    // Ensure that the order belongs to the user (or admin can delete any order)
    // Fetch the order's status (valide)
    $orderStmt = $pdo->prepare("SELECT valide, id_client FROM commande WHERE id = ?");
    $orderStmt->execute([$orderId]);
    $order = $orderStmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        echo "Commande non trouvée.";
        exit;
    }

    // Check if the order status is "Pending" (valide == 0) and the user is allowed to delete it
    if ($user['role'] === 'admin' || ($user['id'] === $order['id_client'] && $order['valide'] == 0)) {
        // Delete the order from the ligne_commande table first (cascade deletion)
        $deleteStmt = $pdo->prepare("DELETE FROM ligne_commande WHERE id_commande = ?");
        $deleteStmt->execute([$orderId]);

        // Now delete the order from the commande table
        $deleteStmt = $pdo->prepare("DELETE FROM commande WHERE id = ?");
        $deleteStmt->execute([$orderId]);

        // Redirect back to orders page after deletion
        header('Location: commande.php');
        exit;
    } else {
        // Unauthorized deletion attempt or order not pending
        echo "Vous n'êtes pas autorisé à supprimer cette commande, ou cette commande n'est pas en statut Pending.";
    }
}
?>
