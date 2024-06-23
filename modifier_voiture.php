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
    <title>Modifier Voiture</title>
    <link rel="stylesheet" href="stylephp.css"> <!-- Lien vers le fichier CSS -->
<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', ''); // Connexion à la base de données

    if (isset($_GET["immatriculation"])) { // Si l'immatriculation est définie dans l'URL
        $immatriculation = $_GET["immatriculation"]; // Récupération de l'immatriculation
        $requete = 'SELECT * FROM voiture WHERE immatriculation = :immatriculation'; // Requête SQL pour récupérer les informations de la voiture
        $stmt = $connexion->prepare($requete); // Préparation de la requête
        $stmt->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR); // Association de l'immatriculation
        $stmt->execute(); // Exécution de la requête
        $voiture = $stmt->fetch(PDO::FETCH_ASSOC); // Récupération de la voiture

        if ($voiture) { // Si la voiture existe
            echo "<h1>Modifier voiture</h1>"; 
            echo "<form action='modifier_voiture.php' method='post'>"; // Formulaire de modification
            echo "<input type='hidden' name='immatriculation' value='" . $voiture["immatriculation"] . "'>"; // Champ caché pour l'immatriculation
            echo "Compteur: <input type='number' name='compteur' value='" . $voiture["compteur"] . "' required><br>"; // Champ pour le compteur
            echo "ID Modèle: <input type='number' name='id_modele' value='" . $voiture["id_modele"] . "' required><br>"; // Champ pour l'ID du modèle
            echo "<input type='submit' value='Modifier'>"; // Bouton de validation
            echo "</form>"; // Fin du formulaire
        } else { // Si la voiture n'existe pas
            echo "Erreur : Voiture non trouvée."; // Message d'erreur
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") { // Si le formulaire a été soumis en méthode POST
        $immatriculation = $_POST["immatriculation"]; // Récupération des données du formulaire
        $compteur = $_POST["compteur"]; // Récupération du compteur
        $id_modele = $_POST["id_modele"]; // Récupération de l'ID du modèle

        $requete = 'UPDATE voiture SET compteur = :compteur, id_modele = :id_modele WHERE immatriculation = :immatriculation'; // Requête SQL pour modifier la voiture
        $stmt = $connexion->prepare($requete);  // Préparation de la requête 
        $stmt->bindParam(':compteur', $compteur, PDO::PARAM_INT); // Association du compteur
        $stmt->bindParam(':id_modele', $id_modele, PDO::PARAM_INT); // Association de l'ID du modèle
        $stmt->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR); // Association de l'immatriculation
        $stmt->execute(); // Exécution de la requête

        echo "Voiture modifiée avec succès."; // Message de succès
    }
} catch (PDOException $e) { // En cas d'erreur
    echo "Erreur : " . $e->getMessage() . "<br/>"; // Affichage du message d'erreur
    die(); // Arrêt du script
}
?>
</body>
</html>
