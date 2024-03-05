<?php
    include "../dataBase.php";
$sql= "SELECT * FROM utilisateur";
$req = $bdd->query($sql);
while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
    // Affiche les données (à adapter selon la structure de votre table)
echo "N° " . $row['userID'] . " <br> Nom: " . $row['nomUser'] . " <br> Prénom: " . $row['prenomUser'] . "<br> Email: " . $row['emailUser'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/inscription.css">
    <script src="inscription.js" defer></script>
</head>
<body>
    <h1>verification</h1>

    
</body>

</html>
