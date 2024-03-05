<?php
require('../dataBase/dataBase.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomSite = $_POST['nomSite'];
    $descriptionSite = $_POST['description'];
    $dureeSite = $_POST['duree'];
    $prixSite = $_POST['prix'];

    // Gestion de l'image
    $imageFileName = $_FILES['image']['name'];
    $imageTempName = $_FILES['image']['tmp_name'];
    $imagePath = '../visite/images/' . $imageFileName;

    move_uploaded_file($imageTempName, $imagePath);

    // la requete d'insertion
    $requette = "INSERT INTO `visite`(`visiteID`, `guideID`, `nomVisite`, `descriptionVisite`, `dureeVisite`, `prixVisite`) 
                VALUES ('', '', :nom, :description, :duree, :prix)";

    // preparons la requete
    $requete = $bdd->prepare($requette);

    // liaison des parametres avec les bonnes variables
    $requete->bindParam(':nom', $nomSite);
    $requete->bindParam(':description', $descriptionSite);
    $requete->bindParam(':duree', $dureeSite);
    $requete->bindParam(':prix', $prixSite);
    
    // executoons la requete
    try {
        $requete->execute();
        header('Location: ../pageAccueil/accueil.php');
        exit();
    } catch(PDOException $e){
        echo "Erreur:".$e->getMessage();
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="styles.css">
    <script src="admin.js" defer></script>
    <title>Administrateur</title>
</head>

<body>
    <div class="nouveau"></div>

    <div class="container">
        <h2>Ajouter un nouveau site</h2>
        <form method="post" action="admin.php" enctype="multipart/form-data">
            <label for="nomSite">Nom du site:</label>
            <input type="text" name="nomSite" required>

            <label for="description">Description:</label>
            <textarea name="description" required></textarea>

            <label for="duree">Durée (en jours)</label>
            <input type="number" name="duree" min="1" required>

            <label for="prix">Prix:</label>
            <input type="number" name="prix" min="1000" placeholder="1000 fcfa" required>

            <label for="image">Image:</label>
            <input type="file" name="image" accept="image/*" value="Image" >

            <button type="submit" >Ajouter</button>
        </form>
    </div>
</body>
</html>
