<?php
require_once 'include/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $categorie = $pdo->prepare('SELECT * FROM categorie WHERE id = ?');
    $categorie->execute([$id]);
    $categorie = $categorie->fetch(PDO::FETCH_ASSOC);

    if (!$categorie) {
        die('Catégorie introuvable.');
    }

    if (isset($_POST['modifier'])) {
        $libelle = $_POST['libelle'];
        $description = $_POST['description'];
        $imageName = $categorie['icone'];

        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $imageName = uniqid() . '_' . $image;
            $uploadDir = 'upload/categorie/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
        }

        $sql = 'UPDATE categorie SET libelle = ?, description = ?, icone = ? WHERE id = ?';
        $updated = $pdo->prepare($sql)->execute([$libelle, $description, $imageName, $id]);

        if ($updated) {
            echo '<div class="alert alert-success">Catégorie modifiée avec succès !</div>';
        } else {
            echo '<div class="alert alert-danger">Erreur lors de la modification.</div>';
        }
    }
} else {
    die('ID non fourni.');
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Modifier Catégorie</title>
</head>
<body>
    <h4>Modifier Catégorie</h4>
    <form method="post" enctype="multipart/form-data">
        <label>Libelle</label>
        <input type="text" name="libelle" value="<?= htmlspecialchars($categorie['libelle']) ?>" required>

        <label>Description</label>
        <textarea name="description" required><?= htmlspecialchars($categorie['description']) ?></textarea>

        <label>Image</label>
        <input type="file" name="image">
        <img src="upload/categorie/<?= htmlspecialchars($categorie['icone']) ?>" alt="Image" width="50">

        <button type="submit" name="modifier">Modifier</button>
    </form>
</body>
</html>

