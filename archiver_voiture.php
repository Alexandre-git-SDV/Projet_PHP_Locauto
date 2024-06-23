<!DOCTYPE html>
<html>
<head>
    <!-- Barre de Navigation  -->
    <nav>
        <a href="page accueil.html"> <img src="locauto_remove.png" alt="image"> </a> <!-- Liste des véhicules disponibles -->
        <div class="onglets">
            <a href="https://www.linkedin.com/in/mathis-huard/"> Contact / Support </a> <!-- Formulaire pour ajouter ou supprimer un client -->
        </div>
    </nav>
    <title>Liste des véhicules</title>
    <link rel="stylesheet" href="stylephp.css"> <!-- Lien vers le fichier CSS -->
<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');

    if (isset($_GET["immatriculation"])) {
        $immatriculation = $_GET["immatriculation"];
        $requete = 'UPDATE voiture SET archive = 1 WHERE immatriculation = :immatriculation';
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR);
        $stmt->execute();

        echo "Voiture archivée avec succès. <a href='liste_vehicules.php'>Retour</a>";
    } else {
        echo "Erreur : immatriculation non fournie.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
}
?>
