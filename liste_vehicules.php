<!DOCTYPE html>
<html>
<head>
<title>Liste des véhicules</title>
</head>
<body> 
<h1>Liste des employes par service</h1>
<p>Choisissez un service :</p>
<form action="vehicle.php" method="get">
<select name="immatriculation">
<?php
try {
$connexion = new PDO('mysql:host=localhost;dbname=locauto',
'root', '');
$requete = 'SELECT * FROM voiture';
$resultat = $connexion->query($requete);
while ($ligne = $resultat->fetch()) {
    echo "\t\t<option value ='" . $ligne["immatriculation"] . "'>"
. $ligne["id_voiture"] . "</option>\n";
}
} catch (PDOException $e) {
echo "Erreur : " . $e->getMessage() . "<br/>";
die();
}
?>
</select>
<p> <input type="submit" value="OK">
</form>
</body>
</html>