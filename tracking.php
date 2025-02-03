<?php
// هذا الكود مخصص لمعالجة الطلب
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['order_id'] ?? '';
    $errorMessage = '';
    $orderDetails = null;

    if (!empty($orderId)) {
        // الاتصال بقاعدة البيانات
        include "include/db.php";

        // استعلام للحصول على تفاصيل الطلب
        $stmt = $pdo->prepare("
            SELECT 
                c.id, 
                c.valide, 
                c.total, 
                c.date_creation, 
                u.login as client_name 
            FROM commande c
            JOIN utilisateur u ON c.id_client = u.id
            WHERE c.id = ?
        ");
        $stmt->execute([$orderId]);
        $orderDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$orderDetails) {
            $errorMessage = "Order not found. Please check the order ID.";
        }
    } else {
        $errorMessage = "Please enter an order ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Order Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .order-form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .order-form input, .order-form button {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .order-form input:focus {
            border-color: #4CAF50;
            outline: none;
        }
        .order-form button {
            background: linear-gradient(90deg, #4CAF50, #45a049);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .order-form button:hover {
            background: linear-gradient(90deg, #45a049, #4CAF50);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            transform: translateY(-3px);
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 20px;
        }
        .order-details {
            margin-top: 20px;
        }
        .order-details h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        .order-details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Check Order Status</h1>
        <form class="order-form" method="POST">
            <input 
                type="text" 
                name="order_id" 
                placeholder="Enter Order ID" 
                value="<?= htmlspecialchars($orderId ?? '') ?>" 
                required>
            <button type="submit">Check Status</button>
        </form>

        <?php if (!empty($errorMessage)): ?>
            <div class="error-message"><?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>

        <?php if (!empty($orderDetails)): ?>
            <div class="order-details">
                <h2>Order Details</h2>
                <p><strong>Order ID:</strong> <?= htmlspecialchars($orderDetails['id']) ?></p>
                <p><strong>Client Name:</strong> <?= htmlspecialchars($orderDetails['client_name']) ?></p>
                <p><strong>Date:</strong> <?= htmlspecialchars($orderDetails['date_creation']) ?></p>
                <p><strong>Total:</strong> $<?= number_format($orderDetails['total'], 2) ?></p>
                <p><strong>Status:</strong> 
                    <?php 
                        switch ($orderDetails['valide']) {
                            case 0: echo 'Pending'; break;
                            case 1: echo 'Processed'; break;
                            case 2: echo 'Shipped'; break;
                            case 3: echo 'Delivered'; break;
                            default: echo 'Unknown';
                        }
                    ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
