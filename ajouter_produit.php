<!doctype html>
<html lang="en">
<head>
    <title>Ajouter et Afficher Produits</title>
    <link rel="stylesheet" href="style/ajouter_produit.css">
</head>
<body>
<?php
require_once 'include/db.php';
?>
<div class="container py-2">
    <h4>Ajouter produit</h4>
    <?php
    if (isset($_POST['ajouter'])) {
        $libelle = $_POST['libelle'];
        $prix = $_POST['prix'];
        $discount = $_POST['discount'];
        $categorie = $_POST['categorie'];
        $description = $_POST['description'];
        $date = date('Y-m-d');

        $filename = 'produit.png';
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $filename = uniqid() . $image;
            move_uploaded_file($_FILES['image']['tmp_name'], 'upload/produit/' . $filename);
        }

        if (!empty($libelle) && !empty($prix) && !empty($categorie)) {
            $sqlState = $pdo->prepare('INSERT INTO produit VALUES (null,?,?,?,?,?,?,?)');
            $inserted = $sqlState->execute([$libelle, $prix, $discount, $categorie, $date, $description, $filename]);
            if ($inserted) {
                echo '<div class="alert alert-success" role="alert">Produit ajouté avec succès !</div>';
            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                    Database error (40023).
                </div>
                <?php
            }
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Libelle, prix, catégorie sont obligatoires.
            </div>
            <?php
        }
    }
    ?>
    <form method="post" enctype="multipart/form-data">
        <label class="form-label">Libelle</label>
        <input type="text" class="form-control" name="libelle" required>

        <label class="form-label">Prix</label>
        <input type="number" class="form-control" step="0.1" name="prix" min="0" required>

        <label class="form-label">Discount</label>
        <input type="number" value="0" class="form-control" name="discount" min="0" max="90">

        <label class="form-label">Description</label>
        <textarea class="form-control" name="description"></textarea>

        <label class="form-label">Image</label>
        <input type="file" class="form-control" name="image">

        <?php
        $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <label class="form-label">Catégorie</label>
        <select name="categorie" class="form-control" required>
            <option value="">Choisissez une catégorie</option>
            <?php
            foreach ($categories as $categorie) {
                echo "<option value='" . $categorie['id'] . "'>" . $categorie['libelle'] . "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Ajouter produit" class="btn btn-primary my-2" name="ajouter">
    </form>


    <h4>Liste des Produits</h4>
    <form method="get" action="">
    <label for="categorie">Sélectionnez une catégorie :</label>
    <select name="categorie" id="categorie" class="form-control" required>
        <option value="">-- Choisissez une catégorie --</option>
        <?php
        $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as $categorie) {
            echo '<option value="' . $categorie['id'] . '">' . htmlspecialchars($categorie['libelle']) . '</option>';
        }
        ?>
    </select>
    <button type="submit" class="btn btn-primary mt-2">Afficher les produits</button>
    </form>

    <?php
if (isset($_GET['categorie']) && !empty($_GET['categorie'])) {
    $categorieId = $_GET['categorie'];
    
    $produits = $pdo->prepare('
        SELECT produit.*, categorie.libelle AS categorie_libelle 
        FROM produit
        JOIN categorie ON produit.id_categorie = categorie.id
        WHERE produit.id_categorie = ?
    ');
    $produits->execute([$categorieId]);
    $produits = $produits->fetchAll(PDO::FETCH_ASSOC);

    if (count($produits) > 0) {
        echo '<h4>Produits de la catégorie : ' . htmlspecialchars($produits[0]['categorie_libelle']) . '</h4>';
        echo '<table class="table table-bordered">';
        echo '<thead>
                <tr>
                    <th>ID</th>
                    <th>Libelle</th>
                    <th>Prix</th>
                    <th>Discount</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
              </thead>';
        echo '<tbody>';

        foreach ($produits as $produit) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($produit['id']) . '</td>';
            echo '<td>' . htmlspecialchars($produit['libelle']) . '</td>';
            echo '<td>' . htmlspecialchars($produit['prix']) . ' $</td>';
            echo '<td>' . htmlspecialchars($produit['discount']) . '%</td>';
            echo '<td>' . htmlspecialchars($produit['description']) . '</td>';
            echo '<td><img src="upload/produit/' . htmlspecialchars($produit['image']) . '" alt="Image" width="50"></td>';
            echo '<td><a href="modifier_produit.php?id=' . $produit['id'] . '" class="btn btn-warning">Modifier</a></td>';
            echo '<td><a href="supprimer_produit.php?id=' . $produit['id'] . '" class="btn btn-danger" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce produit ?\');">Supprimer</a></td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Aucun produit trouvé pour cette catégorie.</p>';
        }
    }
    ?>

        
</div>

</body>
</html>
