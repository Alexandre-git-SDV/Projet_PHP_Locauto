<!DOCTYPE html>
<html>
<head>
    <!-- Barre de Navigation  -->
    <nav>
        <a href="page accueil.html"> <img src="locauto_remove.png" alt="image"> </a> 
        <div class="onglets">
            <a href="https://www.linkedin.com/in/mathis-huard/"> Contact / Support </a> 
        </div>
    </nav>
    <title>Liste des véhicules</title>
    <link rel="stylesheet" href="stylephp.css"> <!-- Lien vers le fichier CSS -->
<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', ''); // Connexion à la base de données

    if (isset($_GET["immatriculation"])) { // Vérification de l'existence de l'immatriculation
        $immatriculation = $_GET["immatriculation"]; // Récupération de l'immatriculation
        $requete = 'UPDATE voiture SET archive = 1 WHERE immatriculation = :immatriculation'; // Requête SQL pour archiver la voiture
        $stmt = $connexion->prepare($requete); // Préparation de la requête
        $stmt->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR); // Association de l'immatriculation
        $stmt->execute(); // Exécution de la requête

        echo "Voiture archivée avec succès. <a href='liste_vehicules.php'>Retour</a>"; // Message de succès
    } else { // Si l'immatriculation n'est pas fournie
        echo "Erreur : immatriculation non fournie."; // Message d'erreur
    }
} catch (PDOException $e) { // En cas d'erreur
    echo "Erreur : " . $e->getMessage() . "<br/>"; // Affichage de l'erreur
    die(); // Arrêt du script
}
?>
