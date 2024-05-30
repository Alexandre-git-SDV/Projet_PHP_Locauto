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
// Exercice 2 //  
// $requete = 'SELECT id_voiture FROM voiture WHERE dept ='.$dept;
// $resultat = $connexion->query($requete);
// $ligne = $resultat->fetch();
// echo "<h1> Liste des employés du département : " .$ligne["nom"]. "</h1>";
// Suite du code pour récupérer la liste des employeurs correspondant au département 
$requete = 'SELECT * FROM voiture WHERE immatriculation = :immatriculation';
$stmt = $connexion->prepare($requete);
$stmt->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR);
$stmt->execute();
echo "<table>\n";
echo "\t<tr><th>id_voiture</th>
<th>immatriculation</th>
<th>compteur</th></tr\n>";
while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
echo "\t<tr>\n";
echo "\t\t<td>" . $ligne["id_voiture"] . "</td>\n";
// echo "\t\t<td><a href=formemploye.php?num=".$ligne["num"]." >" . $ligne["nom"] . "</a></td>\n";
echo "\t\t<td>" . $ligne["immatriculation"] . "</td>\n";
echo "\t\t<td>" . $ligne["compteur"] . "</td>\n";
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