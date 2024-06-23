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
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->

<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', ''); // Connexion à la base de données

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Vérifier si le formulaire a été soumis
        $id_client = $_POST["id_client"]; // Récupérer l'ID du client
        $id_voiture = $_POST["id_voiture"]; // Récupérer l'ID de la voiture
        $date_debut = $_POST["date_debut"]; // Récupérer la date de début
        $date_fin = $_POST["date_fin"];  // Récupérer la date de fin
        $compteur_debut = $_POST["compteur_debut"]; // Récupérer le compteur de début

        $requete_verification = 'SELECT * FROM location 
                                 WHERE id_voiture = :id_voiture 
                                 AND ((date_debut <= :date_debut AND date_fin >= :date_debut) 
                                      OR (date_debut <= :date_fin AND date_fin >= :date_fin)
                                      OR (date_debut >= :date_debut AND date_fin <= :date_fin))'; // Vérifier si la voiture est déjà louée pour les dates spécifiées
        $stmt_verification = $connexion->prepare($requete_verification); // Préparation de la requête
        $stmt_verification->bindParam(':id_voiture', $id_voiture, PDO::PARAM_INT); // Lier l'ID de la voiture à la requête
        $stmt_verification->bindParam(':date_debut', $date_debut, PDO::PARAM_STR); // Lier la date de début à la requête
        $stmt_verification->bindParam(':date_fin', $date_fin, PDO::PARAM_STR); // Lier la date de fin à la requête
        $stmt_verification->execute(); // Exécution de la requête

        if ($stmt_verification->rowCount() > 0) { // Si la voiture est déjà louée
            echo "Erreur : Cette voiture est déjà louée pour les dates spécifiées."; // Message d'erreur
        } else { // Si la voiture n'est pas déjà louée
            $requete_archive = 'SELECT archive FROM voiture WHERE id_voiture = :id_voiture'; // Vérifier si la voiture est archivée
            $stmt_archive = $connexion->prepare($requete_archive); // Préparation de la requête
            $stmt_archive->bindParam(':id_voiture', $id_voiture, PDO::PARAM_INT); // Lier l'ID de la voiture à la requête
            $stmt_archive->execute(); // Exécution de la requête
            $voiture = $stmt_archive->fetch(PDO::FETCH_ASSOC); // Récupération de la voiture
 
            if ($voiture['archive'] == 1) { // Si la voiture est archivée
                echo "Erreur : Cette voiture est archivée et ne peut pas être louée."; // Message d'erreur
            } else { // Si la voiture n'est pas archivée
                $requete = 'INSERT INTO location (id_client, id_voiture, date_debut, date_fin, compteur_debut) 
                            VALUES (:id_client, :id_voiture, :date_debut, :date_fin, :compteur_debut)'; // Requête SQL pour louer la voiture
                $stmt = $connexion->prepare($requete); // Préparation de la requête
                $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT); // Lier l'ID du client à la requête
                $stmt->bindParam(':id_voiture', $id_voiture, PDO::PARAM_INT); // Lier l'ID de la voiture à la requête
                $stmt->bindParam(':date_debut', $date_debut, PDO::PARAM_STR); // Lier la date de début à la requête
                $stmt->bindParam(':date_fin', $date_fin, PDO::PARAM_STR); // Lier la date de fin à la requête
                $stmt->bindParam(':compteur_debut', $compteur_debut, PDO::PARAM_INT); // Lier le compteur de début à la requête
                $stmt->execute(); // Exécution de la requête

                echo "Voiture louée avec succès."; // Message de succès
            }
        }
    }
} catch (PDOException $e) { // En cas d'erreur
    echo "Erreur : " . $e->getMessage() . "<br/>"; // Message d'erreur
    die(); // Arrêt du script
}
?>
