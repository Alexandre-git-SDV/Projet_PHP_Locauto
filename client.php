<?php
try { 
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');

    if (isset($_GET["nom_client"])) {
        $nom_client = $_GET["nom_client"];
        $requete = 'SELECT * FROM client WHERE nom LIKE :nom_client';
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':nom_client', $nom_client, PDO::PARAM_STR);
        $stmt->execute();
    }

    echo "<table>\n";
    echo "\t<tr><th>ID Client</th><th>Nom</th><th>Prenom</th><th>Adresse</th><th>Type de client</th><th>Organisation</th><th>Voiture Empruntée</th><th>Date Début</th><th>Date Fin</th><th>Compteur Début</th><th>Compteur Fin</th></tr>\n";
    while ($client = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "\t<tr>\n";
        echo "\t\t<td>" . $client["id_client"] . "</td>\n";
        echo "\t\t<td>" . $client["nom"] . "</td>\n";
        echo "\t\t<td>" . $client["prenom"] . "</td>\n";
        echo "\t\t<td>" . $client["adresse"] . "</td>\n";

        $id_type_de_client = $client["id_type_de_client"];

        // Récupérer le type de client
        $requete2 = 'SELECT * FROM type_de_client WHERE id_type_de_client = :id_type_de_client';
        $stmt2 = $connexion->prepare($requete2);
        $stmt2->bindParam(':id_type_de_client', $id_type_de_client, PDO::PARAM_INT);
        $stmt2->execute();
        $type_de_client = $stmt2->fetch(PDO::FETCH_ASSOC);

        echo "\t\t<td>" . $type_de_client["libelle"] . "</td>\n";

        // Récupérer l'organisation
        $requete3 = 'SELECT organisation.nom FROM organisation
                     JOIN appartient_a ON organisation.id_organisation = appartient_a.id_organisation
                     WHERE appartient_a.id_client = :id_client';
        $stmt3 = $connexion->prepare($requete3);
        $stmt3->bindParam(':id_client', $client["id_client"], PDO::PARAM_INT);
        $stmt3->execute();
        $organisation = $stmt3->fetch(PDO::FETCH_ASSOC);

        echo "\t\t<td>" . $organisation["nom"] . "</td>\n";

        // Récupérer les locations
        $requete4 = 'SELECT location.date_debut, location.date_fin, location.compteur_debut, location.compteur_fin, voiture.immatriculation 
                     FROM location 
                     JOIN voiture ON location.id_voiture = voiture.id_voiture
                     WHERE location.id_client = :id_client';
        $stmt4 = $connexion->prepare($requete4);
        $stmt4->bindParam(':id_client', $client["id_client"], PDO::PARAM_INT);
        $stmt4->execute();
        $location = $stmt4->fetch(PDO::FETCH_ASSOC);

        if ($location) {
            echo "\t\t<td>" . $location["immatriculation"] . "</td>\n";
            echo "\t\t<td>" . $location["date_debut"] . "</td>\n";
            echo "\t\t<td>" . $location["date_fin"] . "</td>\n";
            echo "\t\t<td>" . $location["compteur_debut"] . "</td>\n";
            echo "\t\t<td>" . $location["compteur_fin"] . "</td>\n";
        } else {
            echo "\t\t<td> pas de voiture louée</td>\n";
        }

        echo "\t</tr>\n";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
}
?>
