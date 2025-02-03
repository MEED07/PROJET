<?php
include 'include/db.php';


$totalProduits = $pdo->query("SELECT COUNT(*) FROM produit")->fetchColumn();


$totalUtilisateurs = $pdo->query("SELECT COUNT(*) FROM utilisateur")->fetchColumn();


$totalCommandes = $pdo->query("SELECT COUNT(*) FROM commande")->fetchColumn();


$revenuTotal = $pdo->query("SELECT SUM(total) FROM commande WHERE valide = 1")->fetchColumn() ?? 0;


$recentOrders = $pdo->query("SELECT * FROM commande ORDER BY date_creation DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);


$recentProducts = $pdo->query("SELECT * FROM produit ORDER BY date_creation DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);


$sql = "
SELECT p.libelle, SUM(lc.quantite) AS total_achete
FROM ligne_commande lc
JOIN produit p ON lc.id_produit = p.id
GROUP BY lc.id_produit
ORDER BY total_achete DESC
LIMIT 1;
";


$sql_clients = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="style/dashbordstyle.css?v=<?php echo time(); ?>">
 
</head>
<body>
  <div class="container">
    <aside>
    >
      <div class="top">
        <div class="logo">
          
        </div>
        <div class="close" id="close_btn">
          <span class="material-symbols-sharp">close</span>
        </div>
      </div>
      <div class="sidebar">
      <a href="admin.php">
          <span class="material-symbols-sharp">grid_view</span>
          <h3>Dashbord</h3>
        </a>
        <a href="index.php "target="_blank">
          <span class="material-symbols-sharp">insights</span>
          <h3>Accueil</h3>
        </a>
        
        <a href="commande.php">
          <span class="material-symbols-sharp">receipt_long</span>
          <h3>Commande</h3>
        </a>
        
        
        <a href="ajouter_categorie.php">
          <span class="material-symbols-sharp">add</span>
          <h3>Add Categorie</h3>
        </a>
        <a href="ajouter_produit.php">
          <span class="material-symbols-sharp">add</span>
          <h3>Add Product</h3>
        </a>


        <a href="liste_contact.php">
          <span class="material-symbols-sharp">receipt_long</span>
          <h3>Contact</h3>
        </a>


        <a href="logout.php">
          <span class="material-symbols-sharp">logout</span>
          <h3>Logout</h3>
        </a>
      </div>
      
    </aside>

    <main>
      <h1>Dashboard</h1>
    

      <div class="insights">
        <div class="sales">
          <span class="material-symbols-sharp">trending_up</span>
          <div class="middle">
            <div class="left">
              <h3>Total Produits</h3>
              <h1><?php echo $totalProduits; ?></h1>
            </div>
            <div class="progress">
              <svg>
                <circle r="30" cy="40" cx="40"></circle>
              </svg>
              <div class="number"><p>80%</p></div>
            </div>
          </div>
          
        </div>

        <div class="expenses">
          <span class="material-symbols-sharp">local_mall</span>
          <div class="middle">
            <div class="left">
              <h3>Total Utilisateurs</h3>
              <h1><?php echo $totalUtilisateurs; ?></h1>
            </div>
            <div class="progress">
              <svg>
                <circle r="30" cy="40" cx="40"></circle>
              </svg>
              <div class="number"><p>80%</p></div>
            </div>
          </div>
          
        </div>

        <div class="income">
          <span class="material-symbols-sharp">stacked_line_chart</span>
          <div class="middle">
            <div class="left">
              <h3>Total Commandes</h3>
              <h1><?php echo $totalCommandes; ?></h1>
            </div>
            <div class="progress">
              <svg>
                <circle r="30" cy="40" cx="40"></circle>
              </svg>
              <div class="number"><p>80%</p></div>
            </div>
          </div>
          
        </div>


        <div class="income">
          <span class="material-symbols-sharp">stacked_line_chart</span>
          <div class="middle">
            <div class="left">
            <h3>Produit le plus acheté</h3>
            <h1><?php echo $sql_clients['libelle']; ?></h1>
            <h3>Quantité achetée</h3>
            <h1><?php echo $sql_clients['total_achete']; ?></h1>
            </div>
            <div class="progress">
              <svg>
                <circle r="30" cy="40" cx="40"></circle>
              </svg>
              
            </div>
          </div>
        
        </div>




        <div class="income">
          <span class="material-symbols-sharp">stacked_line_chart</span>
          <div class="middle">
            <div class="left">
              <h3>Revenu Total</h3>
              <h1>$<?php echo number_format($revenuTotal, 2); ?></h1>
            </div>
            <div class="progress">
              <svg>
                <circle r="30" cy="40" cx="40"></circle>
              </svg>
              <div class="number"><p>80%</p></div>
            </div>
          </div>
          
        </div>
      </div>

      <div class="recent_order">
        <h2>Recent Orders</h2>
        <table>
          <thead>
            <tr>
              <th>Total</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recentOrders as $order): ?>
              <tr>
                <td>$<?php echo number_format($order['total'], 2); ?></td>
                <td><?php echo $order['date_creation']; ?></td>
                <td><?php echo $order['valide'] ? 'Validée' : 'En attente'; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <div class="recent_order">
        <h2>Derniers Produits Ajoutés</h2>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nom</th>
              <th>Prix</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recentProducts as $product): ?>
              <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['libelle']; ?></td>
                <td>$<?php echo number_format($product['prix'], 2); ?></td>
                <td><?php echo $product['date_creation']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <a href="#">Show All</a>
    </main>

    <div class="right">
      <div class="top">
        <button id="menu_bar">
          <span class="material-symbols-sharp">menu</span>
        </button>
        <div class="theme-toggler">
          <span class="material-symbols-sharp active">light_mode</span>
          <span class="material-symbols-sharp">dark_mode</span>
        </div>
        <div class="profile">
          <div class="info">
            <p></p>
            <p>Admin</p>
          </div>

          <div class="profile-photo">
            <img src="./images/pexels-italo-melo-2379004.jpg" alt="">
          </div>
        </div>
        
      </div>
      
    </div>
    
  </div>
  <script src="script.js"></script>
</body>
</html>
