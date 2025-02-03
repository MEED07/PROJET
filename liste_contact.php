<?php
// تضمين الاتصال بقاعدة البيانات
include "include/db.php";

try {
    // استعلام لجلب البيانات من جدول contact
    $sql = "SELECT * FROM contact";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // جلب جميع النتائج
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact List</title>
    <link rel="stylesheet" href="style/dashbordstyle.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    
    <style>
       .actions a {
        text-decoration: none;
        color: white;
        background-color: #007BFF;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        margin-right: 5px;
        transition: background-color 0.3s;
    }
    
    .actions a:hover {
        background-color: #0056b3;
    }
    
    .actions a.delete {
        background-color: #FF5733;
    }
    
    .actions a.delete:hover {
        background-color: #c70000;
    }
    </style>
</head>
<body>
<div class="container">
    <aside>
    <div class="sidebar">
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
      </div>
    </aside>
    
    
    <main>
      
        
        <div class="recent_order">
        <h1>Contact List</h1>    
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Issue</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($contacts)): ?>
                    <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><?= htmlspecialchars($contact['id']) ?></td>
                            <td><?= htmlspecialchars($contact['name']) ?></td>
                            <td><?= htmlspecialchars($contact['email']) ?></td>
                            <td><?= htmlspecialchars($contact['phone']) ?></td>
                            <td><?= htmlspecialchars($contact['issue']) ?></td>
                            <td><?= htmlspecialchars($contact['created_at']) ?></td>
                            <td class="actions">
                                <a href="delete_contact.php?id=<?= $contact['id'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete this contact?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">No contacts found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
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
    </div>
    
    <script src="script.js"></script>
</body>
</html>
