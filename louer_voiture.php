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

<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', ''); // Connexion à la base de données

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Vérifier si le formulaire a été soumis
        $id_client = $_POST["id_client"]; // Récupérer le nom du client
        $id_voiture = $_POST["id_voiture"]; // Récupérer le nom de la voiture
        $date_debut = $_POST["date_debut"]; // Récupérer la date de début de la location
        $date_fin = $_POST["date_fin"]; // Récupérer la date de fin de la location
        $compteur_debut = $_POST["compteur_debut"]; // Récupérer le compteur de début de la location
 
        $requete_verification = 'SELECT * FROM location 
                                 WHERE id_voiture = :id_voiture 
                                 AND ((date_debut <= :date_debut AND date_fin >= :date_debut) 
                                      OR (date_debut <= :date_fin AND date_fin >= :date_fin)
                                      OR (date_debut >= :date_debut AND date_fin <= :date_fin))'; // Vérifier si la voiture est déjà louée pour les dates spécifiées
        $stmt_verification = $connexion->prepare($requete_verification); // Préparer la requête
        $stmt_verification->bindParam(':id_voiture', $id_voiture, PDO::PARAM_INT); // Lier le paramètre id_voiture
        $stmt_verification->bindParam(':date_debut', $date_debut, PDO::PARAM_STR); // Lier le paramètre date_debut
        $stmt_verification->bindParam(':date_fin', $date_fin, PDO::PARAM_STR); // Lier le paramètre date_fin
        $stmt_verification->execute(); // Exécuter la requête

        if ($stmt_verification->rowCount() > 0) { // Vérifier si la voiture est déjà louée pour les dates spécifiées
            echo "Erreur : Cette voiture est déjà louée pour les dates spécifiées."; // Afficher un message d'erreur
        } else { // Si la voiture n'est pas déjà louée pour les dates spécifiées
            $requete_archive = 'SELECT archive FROM voiture WHERE id_voiture = :id_voiture'; // Vérifier si la voiture est archivée
            $stmt_archive = $connexion->prepare($requete_archive); // Préparer la requête
            $stmt_archive->bindParam(':id_voiture', $id_voiture, PDO::PARAM_INT); // Lier le paramètre id_voiture
            $stmt_archive->execute(); // Exécuter la requête
            $voiture = $stmt_archive->fetch(PDO::FETCH_ASSOC); // Récupérer la voiture

            if ($voiture['archive'] == 1) { // Vérifier si la voiture est archivée
                echo "Erreur : Cette voiture est archivée et ne peut pas être louée."; // Afficher un message d'erreur
            } else { // Si la voiture n'est pas archivée
                $requete = 'INSERT INTO location (id_client, id_voiture, date_debut, date_fin, compteur_debut) 
                            VALUES (:id_client, :id_voiture, :date_debut, :date_fin, :compteur_debut)'; // Ajouter une location
                $stmt = $connexion->prepare($requete); // Préparer la requête
                $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT); // Lier le paramètre id_client
                $stmt->bindParam(':id_voiture', $id_voiture, PDO::PARAM_INT); // Lier le paramètre id_voiture
                $stmt->bindParam(':date_debut', $date_debut, PDO::PARAM_STR); // Lier le paramètre date_debut
                $stmt->bindParam(':date_fin', $date_fin, PDO::PARAM_STR); // Lier le paramètre date_fin
                $stmt->bindParam(':compteur_debut', $compteur_debut, PDO::PARAM_INT); // Lier le paramètre compteur_debut
                $stmt->execute(); // Exécuter la requête

                echo "Voiture louée avec succès."; // Afficher un message de succès
            }
        }
    }
} catch (PDOException $e) { // Gérer les exceptions
    echo "Erreur : " . $e->getMessage() . "<br/>"; // Afficher l'erreur
    die(); // Arrêter le script
}
?>
