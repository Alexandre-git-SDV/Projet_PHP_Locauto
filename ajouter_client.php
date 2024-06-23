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

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Vérifier si le formulaire a été soumis
        $nom = $_POST["nom"]; // Récupérer le nom du client
        $prenom = $_POST["prenom"]; // Récupérer le prénom du client
        $adresse = $_POST["adresse"]; // Récupérer l'adresse du client
        $id_type_de_client = $_POST["id_type_de_client"]; // Récupérer l'id du type de client
        $id_organisation = $_POST["id_organisation"]; // Récupérer l'id de l'organisation

        $requete = 'INSERT INTO client (nom, prenom, adresse, id_type_de_client) 
                    VALUES (:nom, :prenom, :adresse, :id_type_de_client)'; // Requête SQL pour ajouter un client
        $stmt = $connexion->prepare($requete); // Préparer la requête
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR); // Lier le nom du client
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR); // Lier le prénom du client
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR); // Lier l'adresse du client
        $stmt->bindParam(':id_type_de_client', $id_type_de_client, PDO::PARAM_INT); // Lier l'id du type de client
        $stmt->execute(); // Exécuter la requête

        $id_client = $connexion->lastInsertId(); // Récupérer l'id du client ajouté

        $requete2 = 'INSERT INTO appartient_a (id_client, id_organisation) 
                     VALUES (:id_client, :id_organisation)'; // Requête SQL pour ajouter un client à une organisation
        $stmt2 = $connexion->prepare($requete2); // Préparer la requête
        $stmt2->bindParam(':id_client', $id_client, PDO::PARAM_INT); // Lier l'id du client
        $stmt2->bindParam(':id_organisation', $id_organisation, PDO::PARAM_INT); // Lier l'id de l'organisation
        $stmt2->execute(); // Exécuter la requête

        echo "Client ajouté avec succès."; // Message de succès
    }
} catch (PDOException $e) { // Gestion des erreurs
    echo "Erreur : " . $e->getMessage() . "<br/>"; // Afficher l'erreur
    die(); // Arrêter le script
}
?>
