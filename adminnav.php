<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="style/dashbordstyle.css">
</head>
<body>
  <div class="container">
    <aside>
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

        <a href="logout.php">
          <span class="material-symbols-sharp">logout</span>
          <h3>Logout</h3>
        </a>


        
        <div class="right">
      <div class="top">
        <button id="menu_bar">
          <span class="material-symbols-sharp">menu</span>
        </button>
        <a href="#">
        <div class="theme-toggler">
          <span class="material-symbols-sharp active">light_mode</span>
          <span class="material-symbols-sharp">dark_mode</span>
        </div></a>
        <div class="profile">
          <div class="info">
            <p></p>
            <p>Admin</p>
          </div>
        </div>
        
      </div>
      
    </div>
      </div>
    </aside>

   
  <script src="script.js"></script>
</body>
</html>
