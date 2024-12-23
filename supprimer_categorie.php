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

    $delete = $pdo->prepare('DELETE FROM categorie WHERE id = ?');
    if ($delete->execute([$id])) {
        if (file_exists('upload/categorie/' . $categorie['icone'])) {
            unlink('upload/categorie/' . $categorie['icone']);
        }
        echo '<div class="alert alert-success">Catégorie supprimée avec succès !</div>';
    } else {
        echo '<div class="alert alert-danger">Erreur lors de la suppression.</div>';
    }
} else {
    die('ID non fourni.');
}
?>
