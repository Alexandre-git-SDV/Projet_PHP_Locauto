<!DOCTYPE html>
<html>
<head>
    <!-- Barre de Navigation  -->
    <nav>
        <a href="page accueil.html"> <img src="locauto_remove.png" alt="image"> </a> <!-- Liste des vehicules disponible -->

        <div class="onglets">
            <a href=""> Contact / Support </a> <!-- Formulaire pour ajouter ou supprimer un client -->
        </div>
    </nav>
    <title>Liste des véhicules</title>
    <link rel="stylesheet" href="stylephp.css"> <!-- Lien vers le fichier CSS -->
    <style>
        /* Inline CSS for the borders and layout */
        .wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .car-item {
            border: 2px solid #000;
            padding: 10px;
            text-align: center;
            width: 150px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .car-item img {
            width: 100px;
            height: auto;
            cursor: pointer;
        }
        .car-item label {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body> 
<h1>Liste des véhicules</h1>
<p>Choisissez un véhicule :</p>
<form action="vehicle.php" method="get">

<div class="wrapper">
    
<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');
    $requete = 'SELECT voiture.immatriculation, modele.image, modele.libelle FROM voiture JOIN modele ON voiture.id_modele = modele.id_modele';
    $resultat = $connexion->query($requete);
    while ($ligne = $resultat->fetch()) {
        $image_path = 'images/' . $ligne["image"];
        // afficher le nom du modèle
        echo "<div class='car-item' style='border: 2px solid #000; border-radius: 10px; padding: 10px; margin: 10px; text-align: center; width: 150px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1); background-color: #fff;'><label style='display: block; margin-bottom: 10px;'>" . $ligne["libelle"] . "</label>";
        echo "<input type='radio' name='immatriculation' value='" . $ligne["immatriculation"] . "' style='display:none;'>";
        echo "<img src='" . $image_path . "' alt='Image de voiture' style='width: 100px; height: auto; cursor: pointer;' onclick='this.previousElementSibling.checked=true;'>";
        echo "</div>";
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
