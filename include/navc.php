<?php


// Ajout d'un produit dans le panier
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Initialiser le panier si ce n'est pas encore fait
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

    // Vérifier si le produit est déjà dans le panier
    if (isset($_SESSION['panier'][$product_id])) {
        // Ajouter la quantité à l'existant
        $_SESSION['panier'][$product_id] += $quantity;
    } else {
        // Ajouter un nouvel article dans le panier
        $_SESSION['panier'][$product_id] = $quantity;
    }
}

// Afficher le nombre d'articles dans le panier
$cart_count = isset($_SESSION['panier']) ? array_sum($_SESSION['panier']) : 0;




// Ajout d'un produit à la wishlist
if (isset($_POST['add_to_wishlist'])) {
    $product_id = $_POST['product_id'];

    // Initialiser la wishlist si ce n'est pas encore fait
    if (!isset($_SESSION['wishlist'])) {
        $_SESSION['wishlist'] = [];
    }

    // Ajouter un produit à la wishlist
    if (!in_array($product_id, $_SESSION['wishlist'])) {
        $_SESSION['wishlist'][] = $product_id;
    }
}

// Afficher le nombre d'articles dans la wishlist
$wishlist_count = isset($_SESSION['wishlist']) ? count($_SESSION['wishlist']) : 0;







// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    try {
        // Connexion à la base de données
        $pdo = new PDO('mysql:host=localhost;dbname=ecommerce', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        // Requête pour récupérer le nombre total de commandes pour l'utilisateur connecté
        $stmt = $pdo->prepare("SELECT COUNT(*) AS total_commandes FROM commande WHERE id_client = ?");
        $stmt->execute([$user_id]);

        // Récupérer le résultat
        $result = $stmt->fetch();
        $commandes_count = $result['total_commandes'] ?? 0;
    } catch (PDOException $e) {
        // Gérer les erreurs de connexion ou d'exécution
        echo "Erreur : " . $e->getMessage();
        $commandes_count = 0;
    }
} else {
    // Si l'utilisateur n'est pas connecté, le nombre de commandes est 0
    $commandes_count = 0;
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apple Clone</title>
    <link rel="stylesheet" href="style/nav.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
   </head>
<body>
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <img src="images/png-apple-logo-9711.png" alt="logo">
                <?php
                if (isset($_SESSION['login'])) {
                    echo "Bienvenue, " . $_SESSION['login'] . "!";
                } else {
                    echo "Bienvenue, visiteur !";
                }
                
                ?>
            </div>
            <div class="toggle" onclick="toggleMenu()">
               
                <i class="fas fa-times cross"></i>
            </div>
            <ul id="nav-list" class ="menu">
               
                <li><a href="index.php">Store</a> </li>
                <li><a href="Mac.php">Mac</a> </li>
                <li><a href="iPad.php">iPad</a> </li>
                <li><a href="phone.php">iPhone</a></li>
                <li><a href="Watch.php">Watch</a> </li>
                <li><a href="AirPods.php">AirPods</a> </li>
                <li><a href="Support.php">Support</a> </li>
                <li>
                    <a href="search.php">
                    <i class="fa fa-search"></i>
                    </a>
                </li>
                

                <li class="wishlist-lgo" > 
                    <a href="wishlist.php">
                        <i class="fa-solid fa-heart"></i>
                        <span class="wishlist-count"></span>
                    </a>
                </li>

                <li class="panier-lgo">
                    <a href="panier.php" class="cart-link">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count"></span>
                    </a>
                </li>
                <li class="commande-lgo">
                    <a href="commande.php">
                        <i class="fa-sharp-duotone fa-solid fa-truck-ramp-box"></i>
                        <span class="commande-count"></span>
                    </a>
                </li>
                <li>
                
                <a href="" id="darkModeToggle" class="dark-mode-btn">🌙</a>

                </li>
            </ul>

            

  
            <?php
            if (isset($_SESSION['login'])) {
                echo '<a href="logout.php" class="login">Logout</a>';
            } else {
                echo '<a href="login.php" class="login">Login</a>';
            }
            ?>
    
</div>



        </div>

        <div class="offers">
          
        </div>
    </div>

    <script>
        function toggleMenu() {
            let menu = document.querySelector('.menu');
            menu.classList.toggle('active');

        }
        </script>

    <style>
                .login {
    display: inline-block;
    background-color: #005bb5;
    color: #ffffff;
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
    transition: background 0.3s ease, transform 0.2s ease;
}

.login:hover {
    background-color:rgb(0, 0, 0); /* Bleu plus foncé au survol */
    transform: scale(1.05);
}
        .dark-mode .navbar {
        background-color: #1c1c1c;
        color: #ffffff;
    }
    .dark-mode .navbar  a  {
        
        color:rgb(255, 255, 255);
    }

    </style>
</body>
</html>
