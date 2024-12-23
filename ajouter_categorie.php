<!doctype html>
<html lang="en">
<head>
    <title>Ajouter et Afficher Catégories</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background: #ffffff;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h4 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

/* Formulaire */
form {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    margin-top: 10px;
    display: block;
}

input, textarea, select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

textarea {
    resize: vertical;
}

input[type="submit"] {
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: center;
}

table th {
    background-color: #007bff;
    color: white;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table img {
    border-radius: 5px;
}

/* Alertes */
.alert {
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

    </style>
</head>
<body>
<?php
require_once 'include/db.php';
?>
<div class="container py-2">
    <h4>Ajouter Catégorie</h4>
    <?php
    if (isset($_POST['ajouter'])) {
        $libelle = $_POST['libelle'];
        $description = $_POST['description'];
        $imageName = 'default.png';

        // Gestion de l'image
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $imageName = uniqid() . '_' . $image; // Renommer l'image pour éviter les conflits
            $uploadDir = 'upload/categorie/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
        }

        if (!empty($libelle) && !empty($description)) {
            $sqlState = $pdo->prepare('INSERT INTO categorie (libelle, description, icone) VALUES (?, ?, ?)');
            $inserted = $sqlState->execute([$libelle, $description, $imageName]);
            if ($inserted) {
                echo '<div class="alert alert-success" role="alert">Catégorie ajoutée avec succès !</div>';
            } else {
                ?>
                <div class="alert alert-danger" role="alert">
                    Une erreur est survenue lors de l\'ajout de la catégorie.
                </div>
                <?php
            }
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                Libelle et description sont obligatoires.
            </div>
            <?php
        }
    }
    ?>
    <form method="post" enctype="multipart/form-data">
        <label class="form-label">Libelle</label>
        <input type="text" class="form-control" name="libelle" required>

        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" required></textarea>

        <label class="form-label">Image</label>
        <input type="file" class="form-control" name="image" required>

        <input type="submit" value="Ajouter catégorie" class="btn btn-primary my-2" name="ajouter">
    </form>

    <h4>Liste des Catégories</h4>
    <?php
    $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);

    if (count($categories) > 0) {
        echo '<table class="table table-bordered">';
        echo '<thead>
                <tr>
                    <th>ID</th>
                    <th>Libelle</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Date de création</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
              </thead>';
        echo '<tbody>';

        foreach ($categories as $categorie) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($categorie['id']) . '</td>';
            echo '<td>' . htmlspecialchars($categorie['libelle']) . '</td>';
            echo '<td>' . htmlspecialchars($categorie['description']) . '</td>';
            echo '<td><img src="upload/categorie/' . htmlspecialchars($categorie['icone']) . '" alt="Image" width="50"></td>';
            echo '<td>' . htmlspecialchars($categorie['date_creation']) . '</td>';
            echo '<td><a href="modifier_categorie.php?id=' . $categorie['id'] . '" class="btn btn-warning">Modifier</a></td>';
            echo '<td><a href="supprimer_categorie.php?id=' . $categorie['id'] . '" class="btn btn-danger" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette catégorie ?\');">Supprimer</a></td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Aucune catégorie trouvée.</p>';
    }
    ?>
</div>

</body>
</html>
