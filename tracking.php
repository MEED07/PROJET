<?php

include "include/db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = htmlspecialchars($_POST['order-id']);

    if (!empty($order_id)) {
        echo "<h1>Order Status</h1>";
        echo "<p>Order ID: " . $order_id . " is being processed.</p>";
    } else {
        echo "<p>Error: Order ID is required.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tracking</title>
    <link rel="stylesheet" href="tracking.css">
</head>
<body>
    <header>
        <h1>Order Tracking</h1>
    </header>
    <main>
        <section class="content">
            <h2>Track Your Orders</h2>
            <p>Stay updated with your orders and delivery status. Simply enter your order ID to get started.</p>
            <form action="track_order.php" method="post">
                <div class="form-group">
                    <label for="order-id">Order ID:</label>
                    <input type="text" id="order-id" name="order-id" required>
                </div>
                <button type="submit" class="btn">Track</button>
            </form>
        </section>
    </main>
    <style>
        /* General Styles */
body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(135deg, #f5f8fa, #e6edf2);
    color: #333;
    padding: 20px;
    margin: 0;
}

header {
    background: linear-gradient(135deg, #28a745, #218838);
    color: #fff;
    text-align: center;
    padding: 30px 0;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

header h1 {
    font-size: 3rem;
    margin: 0;
}

/* Content Section */
.content {
    max-width: 800px;
    background: #fff;
    margin: 50px auto;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.content:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
}

/* Form */
.form-group {
    margin: 20px 0;
    text-align: left;
}

.form-group label {
    font-size: 1.1rem;
    color: #333;
}

.form-group input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
}

/* Button */
.btn {
    text-decoration: none;
    background: #28a745;
    color: #fff;
    padding: 12px 25px;
    border-radius: 25px;
    transition: background 0.3s ease, transform 0.3s ease;
    display: inline-block;
    font-size: 1rem;
    font-weight: bold;
}

.btn:hover {
    background: #218838;
    transform: scale(1.05);
}

    </style>
</body>
</html>
