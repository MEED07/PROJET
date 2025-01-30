<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ecommerce'; 

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for search filters
$search_name = '';
$search_min_price = '';
$search_max_price = '';
$search_category = '';

// Handle POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search_name = isset($_POST['name']) ? $_POST['name'] : '';
    $search_min_price = isset($_POST['min_price']) ? $_POST['min_price'] : '';
    $search_max_price = isset($_POST['max_price']) ? $_POST['max_price'] : '';
    $search_category = isset($_POST['category']) ? $_POST['category'] : '';
}

// Fetch categories for the dropdown
$categories_query = "SELECT id, libelle FROM categorie";
$categories_result = $conn->query($categories_query);

// Initialize result set to empty
$result = null;

// Process search query only if filters are provided
if (!empty($search_name) || !empty($search_min_price) || !empty($search_max_price) || !empty($search_category)) {
    // Prepare SQL query
    $sql = "SELECT produit.id, produit.libelle AS product_name, produit.prix, produit.image, categorie.libelle AS category_name
            FROM produit
            JOIN categorie ON produit.id_categorie = categorie.id
            WHERE 1=1";

    // Add filters if set
    if (!empty($search_name)) {
        $sql .= " AND produit.libelle LIKE '%" . $conn->real_escape_string($search_name) . "%'";
    }
    if (!empty($search_min_price)) {
        $sql .= " AND produit.prix >= " . $conn->real_escape_string($search_min_price);
    }
    if (!empty($search_max_price)) {
        $sql .= " AND produit.prix <= " . $conn->real_escape_string($search_max_price);
    }
    if (!empty($search_category)) {
        $sql .= " AND categorie.id = " . $conn->real_escape_string($search_category);
    }

    // Execute query
    $result = $conn->query($sql);
}

// Handle "Add to Panier" functionality

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if (isset($_POST['add_to_panier'])) {
    $productId = $_POST['product_id'];
    $_SESSION['panier'][$productId] = (isset($_SESSION['panier'][$productId]) ? $_SESSION['panier'][$productId] : 0) + 1;
    header("Location: panier.php"); // Redirect to the panier page
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Products</title>
    <style>
        .produit{ font-family: Arial, sans-serif; margin: 20px; }
        .search-bar { margin-bottom: 20px; }
        h1{
            margin-top: 60px;
        }
        .search-bar input, .search-bar select, .search-bar button {
            padding: 8px; margin-right: 10px; font-size: 16px;
        }
        .product { display: flex; align-items: center; margin-bottom: 20px; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .product img { width: 100px; height: 100px; margin-right: 20px; border-radius: 5px; }
        .product-details { flex-grow: 1; }
        .product-name { font-size: 18px; font-weight: bold; }
        .product-price { color: green; font-size: 16px; }
        .btn-panier { background-color: #007BFF; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        .btn-panier:hover { background-color: #0056b3; }
    </style>
</head>
<body>
<?php
include_once "include/nav.php";

?>
<div class="produit">
    <h1>Search Products</h1>
    <form method="POST" action="" class="search-bar">
        <input type="text" name="name" placeholder="Product Name" value="<?php echo htmlspecialchars($search_name); ?>">
        <input type="number" name="min_price" placeholder="Min Price" value="<?php echo htmlspecialchars($search_min_price); ?>">
        <input type="number" name="max_price" placeholder="Max Price" value="<?php echo htmlspecialchars($search_max_price); ?>">
        <select name="category">
            <option value="">All Categories</option>
            <?php while ($row = $categories_result->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>" <?php echo $search_category == $row['id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($row['libelle']); ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Search</button>
    </form>

    <?php if ($result && $result->num_rows > 0): ?>
        <div >
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product">
                    <img src="upload/produit/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                    <div class="product-details">
                        <div class="product-name"><?php echo htmlspecialchars($row['product_name']); ?></div>
                        <div class="product-price">$<?php echo htmlspecialchars($row['prix']); ?></div>
                        <div class="product-category"><?php echo htmlspecialchars($row['category_name']); ?></div>
                    </div>
                    <form method="POST" style="margin-left: auto;">
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="add_to_panier" class="btn-panier">Add to Panier</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>No products found matching your criteria.</p>
    <?php endif; ?>
    </div>
    <?php $conn->close(); 
    ?>
</body>
</html>
