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
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
    <style>
        /* Zone de style pour le design */
        body {
            font-family: Arial, sans-serif;
            background-color: #94a9d7;
            text-align: center;
        }
    </style>
<?php
try { 
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', ''); // Connexion à la base de données

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Vérification si le formulaire a été soumis
        $immatriculation = $_POST["immatriculation"]; // Récupération de l'immatriculation
        $compteur = $_POST["compteur"]; // Récupération du compteur
        $id_modele = $_POST["id_modele"]; // Récupération de l'ID du modèle

        // Insérer la voiture dans la table voiture
        $requete = 'INSERT INTO voiture (immatriculation, compteur, id_modele) 
                    VALUES (:immatriculation, :compteur, :id_modele)'; // Requête SQL pour insérer une voiture
        $stmt = $connexion->prepare($requete); // Préparation de la requête
        $stmt->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR); // Binder les paramètres (immatriculation)
        $stmt->bindParam(':compteur', $compteur, PDO::PARAM_INT); // Binder les paramètres (compteur)
        $stmt->bindParam(':id_modele', $id_modele, PDO::PARAM_INT); // Binder les paramètres (ID du modèle)
        $stmt->execute(); // Exécution de la requête

        echo "Véhicule ajouté avec succès."; // Message de succès
    }
} catch (PDOException $e) { // Gestion des exceptions
    echo "Erreur : " . $e->getMessage() . "<br/>"; // Affichage du message d'erreur
    die(); // Arrêt du script
}
?>
