<!DOCTYPE html>
<html>
<head>
<title>Client</title>
</head>
<body>
<?php
try { 
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');

    if (isset($_GET["id_client"])) {
        $id_client = $_GET["id_client"];
        $requete = 'SELECT * FROM client WHERE id_client = :id_client';
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);
        $stmt->execute();
    } elseif (isset($_GET["nom_client"])) {
        $nom_client = $_GET["nom_client"];
        $requete = 'SELECT * FROM client WHERE nom LIKE :nom_client';
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':nom_client', $nom_client, PDO::PARAM_STR);
        $stmt->execute();
    } else {
        echo "Aucun client spécifié.";
        exit;
    }

    echo "<table>\n";
    echo "\t<tr><th>ID Client</th><th>Nom</th><th>Prenom</th><th>Adresse</th><th>Type de client</th><th>Organisation</th></tr>\n";
    while ($client = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id_type_de_client = $client["id_type_de_client"];

        $requete2 = 'SELECT * FROM type_de_client WHERE id_type_de_client = :id_type_de_client';
        $stmt2 = $connexion->prepare($requete2);
        $stmt2->bindParam(':id_type_de_client', $id_type_de_client, PDO::PARAM_INT);
        $stmt2->execute();

        $type_de_client = $stmt2->fetch(PDO::FETCH_ASSOC);

        echo "\t<tr>\n";
        echo "\t\t<td>" . $client["id_client"] . "</td>\n";
        echo "\t\t<td>" . $client["nom"] . "</td>\n";
        echo "\t\t<td>" . $client["prenom"] . "</td>\n";
        echo "\t\t<td>" . $client["adresse"] . "</td>\n";
        echo "\t\t<td>" . $type_de_client["libelle"] . "</td>\n";
        echo "\t</tr>\n";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
}
?>
</body>
</html>
