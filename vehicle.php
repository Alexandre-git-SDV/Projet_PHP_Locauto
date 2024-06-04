<!DOCTYPE html>
<html>
<head>
<title>Véhicule</title>
</head>
<body>
<?php
$immatriculation = $_GET["immatriculation"];
try { 
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');
    $requete = 'SELECT * FROM voiture WHERE immatriculation = :immatriculation';
    $stmt = $connexion->prepare($requete);
    $stmt->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR);
    $stmt->execute();
    echo "<table>\n";
    echo "\t<tr><th>id_voiture</th><th>immatriculation</th><th>compteur</th><th>modele</th><th>marque</th><th>image</th></tr>\n";
    while ($voiture = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id_modele = $voiture["id_modele"];
        
        $requete2 = 'SELECT * FROM modele WHERE id_modele = :id_modele';
        $stmt2 = $connexion->prepare($requete2);
        $stmt2->bindParam(':id_modele', $id_modele, PDO::PARAM_INT);
        $stmt2->execute();
        
        $modele = $stmt2->fetch(PDO::FETCH_ASSOC);
        $id_marque = $modele["id_marque"];

        $requete3 = 'SELECT * FROM marque WHERE id_marque = :id_marque';
        $stmt3 = $connexion->prepare($requete3);
        $stmt3->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
        $stmt3->execute();

        $marque = $stmt3->fetch(PDO::FETCH_ASSOC);
        $image_path = 'images/' . $modele["image"];
        
        echo "\t<tr>\n";
        echo "\t\t<td>" . $voiture["id_voiture"] . "</td>\n";
        echo "\t\t<td>" . $voiture["immatriculation"] . "</td>\n";
        echo "\t\t<td>" . $voiture["compteur"] . "</td>\n";
        echo "\t\t<td>" . $modele["libelle"] . "</td>\n";
        echo "\t\t<td>" . $marque["libelle"] . "</td>\n";
        echo "\t\t<td><img src='" . $image_path . "' alt='Image de voiture' style='width:100px;height:auto;'><br>" . $image_path . "</td>\n";  // Affiche le chemin de l'image pour le débogage
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
