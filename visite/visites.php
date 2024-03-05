<?php
require_once ('../dataBase/dataBase.php');

// Initialisez une variable pour stocker le contenu des résultats
$resultsHTML = '';

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    if (!empty($query)) {
        try {
            $stmt = $bdd->prepare("SELECT nomVisite, descriptionVisite, prixVisite FROM visite WHERE nomVisite LIKE :query OR descriptionVisite LIKE :query");
            $stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($results)) {
                foreach ($results as $result) {
                    $resultsHTML .= '<div class="result">';
                    $resultsHTML .= '<h2>' . $result['nomVisite'] . '</h2>';
                    $resultsHTML .= '<p> Description:' . $result['descriptionVisite'] . '</p>';
                    if (isset($result['prixVisite'])) {
                    $resultsHTML .= '<p>Prix: ' . $result['prixVisite'] . ' FCFA</p>';
                } else {
                    $resultsHTML .= '<p>Prix non disponible</p>';
                }

                    // Générez le chemin de l'image en fonction du nom de la visite
                    $formatImage = ['jpg', 'jpeg', 'png', 'gif']; // Ajoutez d'autres extensions au besoin

                    // Générer le nom du fichier en fonction de la première extension disponible
                    foreach ($formatImage as $format) {
                        $imageName = strtolower(str_replace(' ', '_', $result['nomVisite'])) . '.' . $format;
                        $imagePath = 'images/' . $imageName;

                        if (file_exists($imagePath)) {
                            break; 
                        }
                    }

                    $imagePath = 'images/' . $imageName;

                    $resultsHTML .= '<img src="' . $imagePath . '" alt="' . $result['nomVisite'] . '">';

                    $reservationLink = '../pageReservation/reserve.php'; 
                    $resultsHTML .= '<button  class="reservationButton"> <a href="'.$reservationLink.'">Réserver</a></button>';
                    $resultsHTML .= '</div>';
                }
            } else {
                $resultsHTML = 'Aucun résultat trouvé.';
            }
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
        }
    } else {
        $resultsHTML = 'Veuillez entrer un terme de recherche.';
    }
}
?>




<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="visites.css"> -->
    <link rel="stylesheet" href="visites.css">
    <title>Visites</title>
</head>
<body>
    <header>
        <a href="../pageAccueil/accueil.php">
        <div class="uno">
        <p> <span>E-TOUR </span><br> <strong>COTE D'IVOIRE</strong></p>
        </div>
        </a>
        <div class="dropdown">
            <button class="dropbtn">Catégories</button>
            <div class="dropdown-content">
            <a href="#">Hôtels</a>
            <a href="#">Attractions</a>
            <a href="#">Restaurants</a>
            <a href="#">Activités</a>
        </div>
    </header>
    <div class="dos">
        <p>Découvrez <span>des Expériences Uniques</span></p>
    </div>
    <div class="searchcontainer">
        <form action="visites.php" method="GET">
            <input type="text" name="query" id="searchInput" placeholder="Rechercher..." size="110">
            <button type="submit">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c6/Search_font_awesome.svg/512px-Search_font_awesome.svg.png" height="22" width="22">
            </button>
        </form>
    </div>
    <div id="searchResults" class="recherche" >
    <?php echo $resultsHTML; ?>
    </div>

    
</body>
</html>