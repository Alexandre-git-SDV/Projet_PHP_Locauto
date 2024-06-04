<!DOCTYPE html>
<html>
<head>
<title>Liste des véhicules</title>
</head>
<body> 
<h1>Liste des véhicules</h1>
<p>Choisissez un véhicule :</p>
<form action="vehicle.php" method="get">
<div>
<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');
    $requete = 'SELECT voiture.immatriculation, modele.image, modele.libelle FROM voiture JOIN modele ON voiture.id_modele = modele.id_modele';
    $resultat = $connexion->query($requete);
    while ($ligne = $resultat->fetch()) {
        $image_path = 'images/' . $ligne["image"];
        // afficher le nom du modèle
        echo "<label style='display:inline-block; text-align:center; margin:10px;'>" . $ligne["libelle"] . "</label>";
        echo "<label style='display:inline-block; text-align:center; margin:10px;'>";
        echo "<input type='radio' name='immatriculation' value='" . $ligne["immatriculation"] . "' style='display:none;'>";
        echo "<img src='" . $image_path . "' alt='Image de voiture' style='width:100px;height:auto; cursor:pointer;' onclick='this.previousElementSibling.checked=true;'>";
        echo "</label>";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
}
?>
</div>
<p><input type="submit" value="OK"></p>
</form>
</body>
</html>

