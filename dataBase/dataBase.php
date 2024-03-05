

    <?PHP

// les informations sur la base de donnée
$server="localhost";
$dbname ="tourisme";
$charset= "utf8";
$username="root";
$password ="";


try{
    $bdd = new PDO('mysql:host='.$server.';dbname='.$dbname.';charset='.$charset, $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die('Erreur : '. $e->getMessage());
}

?>

<?php
    $serv = "localhost";
    $baseDonnees = "shn";
    $charset ="utf8";
    $user = "root";
    $mdp = "";

    try{
        $db = new PDO('mysql:host ='.$serv. '; dbname='.$baseDonnees. ';charset='.$charset, $user,$mdp);
    } catch(PDOException $e){
        die('erreur: '.$e->getMessage());
    }
?>


