<?php 
    // Database connection configuration
    $databases = [
        'ecommerce' => [
            'host' => 'localhost',
            'user' => 'root',  // Remplacez par votre utilisateur MySQL
            'pass' => '',      // Remplacez par votre mot de passe MySQL (si applicable)
            'name' => 'ecommerce'
        ],
        'shopee' => [
            'host' => 'localhost',
            'user' => 'root',  // Utilisez votre nom d'utilisateur
            'pass' => '',      // Utilisez votre mot de passe
            'name' => 'shopee'
        ],
        'store' => [
            'host' => 'localhost',
            'user' => 'root',  // Utilisez votre nom d'utilisateur
            'pass' => '',      // Utilisez votre mot de passe
            'name' => 'store'
        ]
    ];

    // Function to establish database connection
    function connectDatabase($config) {
        try {
            $conn = new PDO(
                "mysql:host={$config['host']};dbname={$config['name']}", 
                $config['user'], 
                $config['pass']
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Dashboard Data Retrieval Functions
    function getEcommerceStats($conn) {
        $stats = [];
        
        // Total Products
        $stmt = $conn->prepare("SELECT COUNT(*) as total_products FROM produit");
        $stmt->execute();
        $stats['total_products'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_products'];
        
        // Total Categories
        $stmt = $conn->prepare("SELECT COUNT(*) as total_categories FROM categorie");
        $stmt->execute();
        $stats['total_categories'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_categories'];
        
        // Total Orders
        $stmt = $conn->prepare("SELECT COUNT(*) as total_orders FROM commande");
        $stmt->execute();
        $stats['total_orders'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_orders'];
        
        // Total Revenue
        $stmt = $conn->prepare("SELECT SUM(total) as total_revenue FROM commande");
        $stmt->execute();
        $stats['total_revenue'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_revenue'];
        
        return $stats;
    }

    function getShopeeStats($conn) {
        $stats = [];
        
        // Total Products
        $stmt = $conn->prepare("SELECT COUNT(*) as total_products FROM product");
        $stmt->execute();
        $stats['total_products'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_products'];
        
        // Total Users
        $stmt = $conn->prepare("SELECT COUNT(*) as total_users FROM user");
        $stmt->execute();
        $stats['total_users'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_users'];
        
        // Product Price Stats
        $stmt = $conn->prepare("SELECT 
            MIN(item_price) as min_price, 
            MAX(item_price) as max_price, 
            AVG(item_price) as avg_price 
            FROM product");
        $stmt->execute();
        $priceStats = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['min_price'] = $priceStats['min_price'];
        $stats['max_price'] = $priceStats['max_price'];
        $stats['avg_price'] = $priceStats['avg_price'];
        
        return $stats;
    }

    function getStoreStats($conn) {
        $stats = [];
        
        // Total Products by Category
        $stmt = $conn->prepare("
            SELECT c.name, COUNT(p.id) as product_count 
            FROM categories c 
            LEFT JOIN products p ON c.id = p.category_id 
            GROUP BY c.id, c.name
        ");
        $stmt->execute();
        $stats['products_by_category'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Price Range
        $stmt = $conn->prepare("
            SELECT 
            MIN(CAST(REPLACE(price, 'From $', '') AS DECIMAL)) as min_price,
            MAX(CAST(REPLACE(price, 'From $', '') AS DECIMAL)) as max_price
            FROM products
        ");
        $stmt->execute();
        $priceRange = $stmt->fetch(PDO::FETCH_ASSOC);
        $stats['min_price'] = $priceRange['min_price'];
        $stats['max_price'] = $priceRange['max_price'];
        
        return $stats;
    }

    // Connect to databases
    $ecommerceConn = connectDatabase($databases['ecommerce']);
    $shopeeConn = connectDatabase($databases['shopee']);
    $storeConn = connectDatabase($databases['store']);

    // Retrieve statistics
    $ecommerceStats = getEcommerceStats($ecommerceConn);
    $shopeeStats = getShopeeStats($shopeeConn);
    $storeStats = getStoreStats($storeConn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Multi-Store Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .dashboard {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 20px;
            width: calc(33.33% - 20px);
            box-sizing: border-box;
        }
        .card h2 {
            margin-top: 0;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Multi-Store Dashboard</h1>
    
    <div class="dashboard">
        <div class="card">
            <h2>E-commerce Store</h2>
            <p>Total Products: <?= $ecommerceStats['total_products'] ?></p>
            <p>Total Categories: <?= $ecommerceStats['total_categories'] ?></p>
            <p>Total Orders: <?= $ecommerceStats['total_orders'] ?></p>
            <p>Total Revenue: $<?= number_format($ecommerceStats['total_revenue'], 2) ?></p>
        </div>
        
        <div class="card">
            <h2>Shopee Store</h2>
            <p>Total Products: <?= $shopeeStats['total_products'] ?></p>
            <p>Total Users: <?= $shopeeStats['total_users'] ?></p>
            <p>Min Product Price: $<?= number_format($shopeeStats['min_price'], 2) ?></p>
            <p>Max Product Price: $<?= number_format($shopeeStats['max_price'], 2) ?></p>
            <p>Avg Product Price: $<?= number_format($shopeeStats['avg_price'], 2) ?></p>
        </div>
        
        <div class="card">
            <h2>Apple Store</h2>
            <h3>Products by Category</h3>
            <?php foreach($storeStats['products_by_category'] as $category): ?>
                <p><?= $category['name'] ?>: <?= $category['product_count'] ?> Products</p>
            <?php endforeach; ?>
            <p>Price Range: $<?= number_format($storeStats['min_price'], 2) ?> - $<?= number_format($storeStats['max_price'], 2) ?></p>
        </div>
    </div>
</body>
</html>
