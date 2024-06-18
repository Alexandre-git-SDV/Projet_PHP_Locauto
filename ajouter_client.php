<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $adresse = $_POST["adresse"];
        $id_type_de_client = $_POST["id_type_de_client"];
        $id_organisation = $_POST["id_organisation"];

        // Ajouter le client à la table client
        $requete = 'INSERT INTO client (nom, prenom, adresse, id_type_de_client) 
                    VALUES (:nom, :prenom, :adresse, :id_type_de_client)';
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->bindParam(':id_type_de_client', $id_type_de_client, PDO::PARAM_INT);
        $stmt->execute();

        // Récupérer l'id du client nouvellement ajouté
        $id_client = $connexion->lastInsertId();

        // Ajouter l'appartenance à l'organisation
        $requete2 = 'INSERT INTO appartient_a (id_client, id_organisation) 
                     VALUES (:id_client, :id_organisation)';
        $stmt2 = $connexion->prepare($requete2);
        $stmt2->bindParam(':id_client', $id_client, PDO::PARAM_INT);
        $stmt2->bindParam(':id_organisation', $id_organisation, PDO::PARAM_INT);
        $stmt2->execute();

        echo "Client ajouté avec succès.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
}
?>
