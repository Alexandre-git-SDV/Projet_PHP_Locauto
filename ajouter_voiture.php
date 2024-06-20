<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $immatriculation = $_POST["immatriculation"];
        $compteur = $_POST["compteur"];
        $id_modele = $_POST["id_modele"];

        // Insérer la voiture dans la table voiture
        $requete = 'INSERT INTO voiture (immatriculation, compteur, id_modele) 
                    VALUES (:immatriculation, :compteur, :id_modele)';
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR);
        $stmt->bindParam(':compteur', $compteur, PDO::PARAM_INT);
        $stmt->bindParam(':id_modele', $id_modele, PDO::PARAM_INT);
        $stmt->execute();

        echo "Véhicule ajouté avec succès.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
}
?>
