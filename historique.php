<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');

    if (isset($_GET["nom_client"])) {
        $nom_client = $_GET["nom_client"];
        $requete = 'SELECT c.id_client, c.nom, c.prenom, l.date_debut, l.date_fin, l.compteur_debut, l.compteur_fin, v.immatriculation 
                    FROM client c
                    LEFT JOIN location l ON c.id_client = l.id_client
                    LEFT JOIN voiture v ON l.id_voiture = v.id_voiture
                    WHERE c.nom LIKE :nom_client';
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':nom_client', $nom_client, PDO::PARAM_STR);
        $stmt->execute();

        $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($locations) > 0) {
            echo "<table>\n";
            echo "\t<tr><th>ID Client</th><th>Nom</th><th>Prénom</th><th>Date Début</th><th>Date Fin</th><th>Compteur Début</th><th>Compteur Fin</th><th>Immatriculation Voiture</th></tr>\n";
            foreach ($locations as $location) {
                echo "\t<tr>\n";
                echo "\t\t<td>" . $location["id_client"] . "</td>\n";
                echo "\t\t<td>" . $location["nom"] . "</td>\n";
                echo "\t\t<td>" . $location["prenom"] . "</td>\n";
                if ($location["date_debut"]) {
                    echo "\t\t<td>" . $location["date_debut"] . "</td>\n";
                    echo "\t\t<td>" . $location["date_fin"] . "</td>\n";
                    echo "\t\t<td>" . $location["compteur_debut"] . "</td>\n";
                    echo "\t\t<td>" . $location["compteur_fin"] . "</td>\n";
                    echo "\t\t<td>" . $location["immatriculation"] . "</td>\n";
                } else {
                    echo "\t\t<td colspan='5'>Pas encore loué de voiture</td>\n";
                }
                echo "\t</tr>\n";
            }
            echo "</table>";
        } else {
            echo "Aucun client trouvé avec ce nom.";
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
}
?>
