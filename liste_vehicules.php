<!DOCTYPE html>
<html>
<head>
<title>Liste des véhicules</title>
</head>
<body> 
<h1>Menu : véhicules</h1>
<p>Choisissez un véhicule :</p>
<form action="vehicle.php" method="get">
<div>
<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');
    $requete = 'SELECT voiture.immatriculation, modele.image, modele.libelle, voiture.archive 
                FROM voiture JOIN modele ON voiture.id_modele = modele.id_modele';
    $resultat = $connexion->query($requete);
    while ($ligne = $resultat->fetch()) {
        $image_path = 'images/' . $ligne["image"];
        echo "<label style='display:inline-block; text-align:center; margin:10px;'>" . $ligne["libelle"] . "</label>";
        echo "<label style='display:inline-block; text-align:center; margin:10px;'>";
        echo "<input type='radio' name='immatriculation' value='" . $ligne["immatriculation"] . "' style='display:none;'>";
        echo "<img src='" . $image_path . "' alt='Image de voiture' style='width:100px;height:auto; cursor:pointer;' onclick='this.previousElementSibling.checked=true;'>";
        echo "</label>";
        echo "<a href='modifier_voiture.php?immatriculation=" . $ligne["immatriculation"] . "'>Modifier</a><br>";
        if ($ligne["archive"] == 0) {
            echo "<a href='archiver_voiture.php?immatriculation=" . $ligne["immatriculation"] . "'>Archiver</a><br>";
        } else {
            echo "<span>Archivé</span><br>";
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
}
?>
</div>
<p><input type="submit" value="OK"></p>
</form>

<h2>Ajouter un véhicule</h2>
<form action="ajouter_voiture.php" method="post">
    <input type="text" name="immatriculation" placeholder="Immatriculation" required>
    <input type="number" name="compteur" placeholder="Compteur" required>
    <input type="number" name="id_modele" placeholder="ID Modèle" required>
    <input type="submit" value="Ajouter">
</form>

</body>
</html>
