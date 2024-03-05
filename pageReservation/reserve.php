<?php
require('../dataBase/dataBase.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date = $_POST['date'];
    $duree = $_POST['duree'];
    $prix = $_POST['amount'];
    $devise = $_POST['currency'];
    



    $sql = "INSERT INTO `reservation`(`reservationID`, `userID`, `visiteID`, `dateReservation`, `dureeReservation`, `prixReservation`, `deviseMonnaie`, `statutPaiement`) 
            VALUES (' ', '1 ', '1 ', :date, :duree, :prix, :devise, '')";

    // Préparons la requête en utilisant la variable $sql
    $requete = $bdd->prepare($sql);

    // Liaison des paramètres avec les bonnes variables
    $requete->bindParam(':date', $date);
    $requete->bindParam(':duree', $duree);
    $requete->bindParam(':prix', $prix);
    $requete->bindParam(':devise', $devise);

    // Exécutons la requête
    try {
        $requete->execute();
        header('Location: ../pageAccueil/accueil.php');
        exit();
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
    }

    // Fermons la connexion avec la base de données
    $bdd = null;
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation</title>
    <!-- <link rel="stylesheet" href="reserve.css"> -->
    <link rel="stylesheet" href="style.css">
    <script src="reserve.js" defer></script>
    <script src="../pageAccueil/accueil.js" defer></script>
    <script src="https://cdn.cinetpay.com/seamless/main.js" type="text/javascript"></script>
    <script src="https://cdn.cinetpay.com/seamless/main.js"></script>
    
    
</head>

<body>

    

        
        <div class="cadre1" >
            <form action="" method="post" class="reservation-form">
                <h2>Réservez votre séjour</h2>

                <div class="form-group">
                    <label for="date">Date de séjour</label>
                    <input type="date" name="date" required>
                </div>

                <div class="form-group">
                    <label for="duree">Durée du séjour (en jours)</label>
                    <input type="number" name="duree" min="1" required>
                </div>

                <div class="form-group">
                    <label for="form-group">Montant:</label>
                    <input type="number" id="amount" name="amount" min="1" placeholder="prix">
                </div>

                <div class="form-group">
                    <label for="currency">Devise:</label>
                    <input type="text" id="currency" name="currency" value="XOF" readonly>
                </div>

                <h3>Choisissez votre moyen de paiement</h3>

                <div class="payment-options">
                    <button onclick="checkout()" class="paiement" type="button" >
                        <img src="../images/orange icon.png" alt="Orange Money" style="width:30px; height:30px">
                        <span>Orange Money</span>
                    </button>

                    <button onclick="checkout()" class="paiement" type="button" >
                        <img src="../images/mtn icon.png" alt="MTN Money" style="width:30px; height:30px">
                        <span>MTN Money</span>
                    </button>

                    <button onclick="checkout()" class="paiement"  type="button" >
                        <img src="../images/wave.png" alt="Moov Money" style="width:30px; height:30px">
                        <span>Wave</span>
                    </button>
                </div>

                <button id="reserver" type="submit">Réserver</button>
            </form>
        </div>




</body>

</html>