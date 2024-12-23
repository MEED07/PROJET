<?php
require_once 'include/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produit = $pdo->prepare('DELETE FROM produit WHERE id = ?');
    $produit->execute([$id]);
    header('Location: ajouter_produit.php');
}
?>
