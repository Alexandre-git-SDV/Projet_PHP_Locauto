<!DOCTYPE html>
<html>
<head>
<title>Client</title>
</head>
<body>
<?php
$id_client = $_GET["id_client"];
try { 
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');
    $requete = 'SELECT * FROM client WHERE id_client = :id_client';
    $stmt = $connexion->prepare($requete);
    $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);
    $stmt->execute();
    echo "<table>\n";
    echo "\t<tr><th>ID Client</th><th>Nom</th><th>Prenom</th><th>Adresse</th><th>Type de client</th><th>Organisation</th></tr>\n";
    while ($client = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id_type_de_client = $client["id_type_de_client"];

        $requete2 = 'SELECT * FROM type_de_client WHERE id_type_de_client = :id_type_de_client';
        $stmt2 = $connexion->prepare($requete2);
        $stmt2->bindParam(':id_type_de_client', $id_type_de_client, PDO::PARAM_INT);
        $stmt2->execute();

        $type_de_client = $stmt2->fetch(PDO::FETCH_ASSOC);
        // $id_organisation = $client["id_organisation"];

        // $requete3 = 'SELECT * FROM organisation WHERE id_organisation = :id_organisation';
        // $stmt3 = $connexion->prepare($requete3);
        // $stmt3->bindParam(':id_organisation', $id_organisation, PDO::PARAM_INT);
        // $stmt3->execute();

        // $organisation = $stmt3->fetch(PDO::FETCH_ASSOC);
        echo "\t<tr>\n";
        echo "\t\t<td>" . $client["id_client"] . "</td>\n";
        echo "\t\t<td>" . $client["nom"] . "</td>\n";
        echo "\t\t<td>" . $client["prenom"] . "</td>\n";
        echo "\t\t<td>" . $client["adresse"] . "</td>\n";
        echo "\t\t<td>" . $type_de_client["libelle"] . "</td>\n";
        // echo "\t\t<td>" . $organisation["nom"] . "</td>\n";
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
