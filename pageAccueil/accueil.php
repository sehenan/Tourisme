<?php
    require('../dataBase/dataBase.php');

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
        // Insertion dans la base de données
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
    
        // Requête SQL avec une préparation pour éviter les injections SQL
        $sql = "INSERT INTO utilisateur(`userID`, `nomUser`, `prenomUser`, `adresseUser`, `emailUser`, `mdpUser`) 
                VALUES ('', :nom, :prenom, :adresse, :email, :mdp)";
    
        // Préparation de la requête
        $requete = $bdd->prepare($sql);
    
        // Liaison des paramètres
        $requete->bindParam(':nom',$nom);
        $requete->bindParam(':prenom', $prenom);
        $requete->bindParam(':adresse', $adresse);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':mdp', $mdp);

    
        // Exécution de la requête
        try {
            $requete->execute();
            header('location: ../pageAccueil/accueil.php');
            // echo "Insertion réussie.";
        } catch (PDOException $e) {
            
            echo "Erreur lors de l'insertion : " . $e->getMessage();
        }
    
        // Fermeture de la connexion à la base de données
        $bdd = null;
        exit();
    }
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Tour</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="accueil.css">
    <script src="accueil.js" defer></script>
    
    <script>
        let startX;
        let startY;

        document.addEventListener('mousedown', function(event) {
            startX = event.clientX;
            startY = event.clientY;
        });

        document.addEventListener('mouseup', function(event) {
            let endX = event.clientX;
            let endY = event.clientY;

            let deltaX = endX - startX;
            let deltaY = endY - startY;

            if (Math.abs(deltaX) > 100) { 
                window.location.href = '../visite/visite.php'; 
            }
        });
    </script>
</head>
<body>
    <header class="premier">
        <div class="premier1">
            <p> <span>E-TOUR </span><br> <strong>COTE D'IVOIRE</strong></p>
            <nav>
                <ul>
                    <!-- <li id="barre"><input type="text" placeholder="recherche" ></li> -->
                    <li><a href="/">ACCUEIL</a></li>
                    <li><a href="../visite/visites.php">VISITES</a></li>
                    <li><a href="../pageReservation/reserve.php">RESERVATIONS</a></li>
                </ul>
            </nav>
            <div class="premier2">
            <a href="javascript:void(0)" onmouseover="afficherFormulaire()" onclick="cacherFormulaire()" >MON COMPTE</a>
                <!-- Ajout du formulaire à la section "Mon Compte" -->
                <div id="formulaire" style="display: none; z-index: 1000;">
                <img id="photoProfil" onclick="choisirImage()" src="../images/basilique-de-yamoussoukro.png" alt="Photo de profil">
                    <form action="" method="post">
                        <label for="nom">Nom:</label>
                        <input type="text" placeholder="Nom" name="nom" required>

                        <label for="prenom">prenom:</label>
                        <input type="text" placeholder="Prénom" name="prenom" required>
                        
                        <label for="adresse">adresse:</label>
                        <input type="text" placeholder="adresse" name="adresse" required>

                        <label for="email">Email:</label>
                        <input type="text" placeholder="Email" name="email"required>

                        <label for="mdp">Mot de passe:</label>
                        <input type="password" placeholder="Mot de passe" name="mdp" required>

                        

                        <input type="file" accept="image/*" capture="camera" onchange="afficherImage(this)" id="inputImage" required>
                        <button type="submit" name="submit">Enregistrer</button>
                    </form>
                </div>
            </div>


        </div>
    </header>
    <section class="deux">
        
        <img src="../images/man-cQALU.webp" alt="image man" width="1310px" height="300px">
        <h1 style="margin-top:-40px;">Bienvenue ... </h1>
        
    </section>
    <section class="trois">
        <h3>Découvrez des Expériences Authentiques</h3>
        <p>Explorez notre sélection de visites guidées, d'activités culturelles et d'expériences locales uniques.</p>
        <div class="trois1">
        
            <a href="">
                <img src="../images/man.avif" alt="" width="  400px" height="250px">
                <span>Man</span>
            </a>
            
            <a href="">
                <img src="../images/IMG-20231226-WA0106-768x375.jpg" alt="" width="400px" height="250px">
                <span>Mets Ivoiriens</span>
            </a>
            <a href="">
                <img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/62/13/f6/caption.jpg?w=500&h=400&s=1https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/62/13/f6/caption.jpg?w=500&h=400&s=1" alt=""  width="400px" height="250px">
                <span>Yamoussokro</span>
            </a>
            
            <a href="">
                <img src="../images/KORHOGO.jpg" alt="culture"  width="400px" height="250px">
                <span>Korhogo</span>
            </a>
            
            <a href="">
                <img src="https://prod.cdn-medias.jeuneafrique.com/cdn-cgi/image/q=auto,f=auto,metadata=none,width=1256,height=628,fit=cover/https://prod.cdn-medias.jeuneafrique.com/medias/2022/02/24/jad20220224-ass-civ-kong-1256x628-1645722039.jpg" alt="kong"  width="400px" height="250px">
                <span>Kong</span>
            </a>
            <a href="">
                <img src="https://yeleefr.files.wordpress.com/2021/02/img_20210130_141640.jpg" alt="pagne kita"  width="400px" height="250px">
                <span>Akans</span>
            </a>
            <a href="">
                <img src="https://yeleefr.files.wordpress.com/2021/02/img_20210130_141640.jpg" alt="pagne kita"  width="400px" height="250px">
                <span>Akans</span>
            </a>
            <a href="">
                <img src="https://yeleefr.files.wordpress.com/2021/02/img_20210130_141640.jpg" alt="pagne kita"  width="400px" height="250px">
                <span>Akans</span>
            </a>
            
        </div>
    </section>
    <section class="quatre">
        
            <h3>Planifiez Votre Prochaine Aventure</h3>
            <p>Créez un itinéraire personnalisé  et réservez facilement vos activités touristiques.</p>
        
        <div class="quatre1">
           <img src="../images/sand-937387_1280-1.jpg" alt="" height="350px" width="1280px">
        </div>
        <a href="reservations.html">Réservez maintenant</a>
    </section>
    
<footer class="site-footer">
    <div class="footer-content">
        <h3>Contactez-nous</h3>
        <p>Email: info@etour.com</p>
        <p>Téléphone: +225 01 72 34 76 44</p>
    </div>
    
    <div class="footer-content">
        <h3>Suivez-nous</h3>
        <ul>
            <!-- <li><a href="#">Facebook</a></li> -->
            <img src="https://img.freepik.com/vecteurs-premium/logo-medias-sociaux-bleu_197792-1759.jpg" alt="" width="50px" height="50px">
            <img src="../images/instagram-icone-nouveau_1057-2227.avif" alt="" width="50px" height="50px">
            <img src="../images/icone-twitter-dans-icones-medias-sociaux-style-papier-decoupe_505135-257.avif" alt="" width="50px" height="50px">
        </ul>
    </div>
    
    <div class="footer-content">
        <h3>Adresse</h3>
        <p>123 Rue de Treichville,  ESATIC, Abidjan</p>
    </div>
</footer>
</body>
</html>