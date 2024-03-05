<?php
require_once ('../dataBase/dataBase.php');

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    if (!empty($query)) {
        try {
            $stmt = $bdd->prepare("SELECT * FROM visite WHERE nomVisite LIKE :query OR descriptionVisite LIKE :query");
            $stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo '<div id="searchResults">';
            if ($results) {
                foreach ($results as $result) {
                    echo '<div class="result">';
                    echo '<h2>' . $result['nomVisite'] . '</h2>';
                    echo '<p>' . $result['descriptionVisite'] . '</p>';
                    echo '</div>';
                }
            } else {
                echo 'Aucun résultat trouvé.';
            }
            echo '</div>';
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
        }
    } else {
        echo 'Veuillez entrer un terme de recherche.';
    }
} else {
    // echo 'Aucun terme de recherche n\'a été spécifié.';
}
?>