<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_client = $_POST["id_client"];
        $id_voiture = $_POST["id_voiture"];
        $date_debut = $_POST["date_debut"];
        $date_fin = $_POST["date_fin"];
        $compteur_debut = $_POST["compteur_debut"];

        // Vérifier si la voiture est déjà louée pour les dates spécifiées
        $requete_verification = 'SELECT * FROM location 
                                 WHERE id_voiture = :id_voiture 
                                 AND ((date_debut <= :date_debut AND date_fin >= :date_debut) 
                                      OR (date_debut <= :date_fin AND date_fin >= :date_fin)
                                      OR (date_debut >= :date_debut AND date_fin <= :date_fin))';
        $stmt_verification = $connexion->prepare($requete_verification);
        $stmt_verification->bindParam(':id_voiture', $id_voiture, PDO::PARAM_INT);
        $stmt_verification->bindParam(':date_debut', $date_debut, PDO::PARAM_STR);
        $stmt_verification->bindParam(':date_fin', $date_fin, PDO::PARAM_STR);
        $stmt_verification->execute();

        if ($stmt_verification->rowCount() > 0) {
            echo "Erreur : Cette voiture est déjà louée pour les dates spécifiées.";
        } else {
            // Vérifier si la voiture est archivée
            $requete_archive = 'SELECT archive FROM voiture WHERE id_voiture = :id_voiture';
            $stmt_archive = $connexion->prepare($requete_archive);
            $stmt_archive->bindParam(':id_voiture', $id_voiture, PDO::PARAM_INT);
            $stmt_archive->execute();
            $voiture = $stmt_archive->fetch(PDO::FETCH_ASSOC);

            if ($voiture['archive'] == 1) {
                echo "Erreur : Cette voiture est archivée et ne peut pas être louée.";
            } else {
                // Insérer la location dans la table location
                $requete = 'INSERT INTO location (id_client, id_voiture, date_debut, date_fin, compteur_debut) 
                            VALUES (:id_client, :id_voiture, :date_debut, :date_fin, :compteur_debut)';
                $stmt = $connexion->prepare($requete);
                $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);
                $stmt->bindParam(':id_voiture', $id_voiture, PDO::PARAM_INT);
                $stmt->bindParam(':date_debut', $date_debut, PDO::PARAM_STR);
                $stmt->bindParam(':date_fin', $date_fin, PDO::PARAM_STR);
                $stmt->bindParam(':compteur_debut', $compteur_debut, PDO::PARAM_INT);
                $stmt->execute();

                echo "Voiture louée avec succès.";
            }
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
}
?>
