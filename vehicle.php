<!DOCTYPE html>
<html>
<head>
<title>Véhicule</title>
</head>
<body>
<?php
// valeur retournée par le formulaire de sélection
$immatriculation = $_GET["immatriculation"];
try { 
$connexion = new PDO('mysql:host=localhost;dbname=locauto',
'root', '');
$requete = 'SELECT * FROM voiture WHERE immatriculation = :immatriculation';
$stmt = $connexion->prepare($requete);
$stmt->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR);
$stmt->execute();
echo "<table>\n";
echo "\t<tr><th>id_voiture</th>
<th>immatriculation</th>
<th>compteur</th>
<th>libelle</th></tr\n>";
while ($voiture = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Récupération de la clé étrangère id_modele de la voiture
    $id_modele = $voiture["id_modele"];
    
    // Requête pour récupérer les informations du modèle
    $requete2 = 'SELECT * FROM modele WHERE id_modele = :id_modele';
    $stmt2 = $connexion->prepare($requete2);
    $stmt2->bindParam(':id_modele', $id_modele, PDO::PARAM_INT);
    $stmt2->execute();
    
    $modele = $stmt2->fetch(PDO::FETCH_ASSOC);
    
    echo "\t<tr>\n";
    echo "\t\t<td>" . $voiture["id_voiture"] . "</td>\n";
    echo "\t\t<td>" . $voiture["immatriculation"] . "</td>\n";
    echo "\t\t<td>" . $voiture["compteur"] . "</td>\n";
    echo "\t\t<td>" . $modele["libelle"] . "</td>\n";
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