<?php
require_once 'include/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produit = $pdo->prepare('SELECT * FROM produit WHERE id = ?');
    $produit->execute([$id]);
    $produit = $produit->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['modifier'])) {
        $libelle = $_POST['libelle'];
        $prix = $_POST['prix'];
        $discount = $_POST['discount'];
        $categorie = $_POST['categorie'];
        $description = $_POST['description'];
        $filename = $produit['image'];

        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $filename = uniqid() . $image;
            move_uploaded_file($_FILES['image']['tmp_name'], 'upload/produit/' . $filename);
        }

        $sql = 'UPDATE produit SET libelle = ?, prix = ?, discount = ?, id_categorie = ?, description = ?, image = ? WHERE id = ?';
        $pdo->prepare($sql)->execute([$libelle, $prix, $discount, $categorie, $description, $filename, $id]);

        header('Location: ajouter_produit.php');
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Modifier Produit</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
    <label>Libelle</label>
    <input type="text" name="libelle" value="<?= $produit['libelle'] ?>" required>
    
    <label>Prix</label>
    <input type="number" name="prix" value="<?= $produit['prix'] ?>" required>
    
    <label>Discount</label>
    <input type="number" name="discount" value="<?= $produit['discount'] ?>" min="0" max="90">
    
    <label>Description</label>
    <textarea name="description"><?= $produit['description'] ?></textarea>
    
    <label>Image</label>
    <input type="file" name="image">
    
    <label>Catégorie</label>
    <select name="categorie" required>
        <?php
        $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as $cat) {
            echo '<option value="' . $cat['id'] . '"' . ($cat['id'] == $produit['id_categorie'] ? ' selected' : '') . '>' . $cat['libelle'] . '</option>';
        }
        ?>
    </select>
    
    <button type="submit" name="modifier">Modifier</button>
</form>
</body>
</html>
