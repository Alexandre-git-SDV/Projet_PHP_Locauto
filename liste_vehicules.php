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
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        .wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 20px;
        }

        .car-item {
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            width: 200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .car-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .car-item img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .car-item label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #0044cc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0033aa;
        }

        .selected {
            border: 2px solid blue;
            box-shadow: 0 0 10px blue;
        }
    </style>
    <script>
        function selectCar(element) {
            // Remove 'selected' class from all car items
            var items = document.getElementsByClassName('car-item');
            for (var i = 0; i < items.length; i++) {
                items[i].classList.remove('selected');
            }
            // Add 'selected' class to the clicked car item
            element.classList.add('selected');
            // Check the associated radio button
            element.querySelector('input[type=radio]').checked = true;
        }
    </script>
</head>
<body>
<h1>Liste des véhicules</h1>
<p style="text-align: center;">Choisissez un véhicule :</p>
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
        echo "<div class='car-item' onclick='selectCar(this)'><label>" . $ligne["libelle"] . "</label>";
        echo "<input type='radio' name='immatriculation' value='" . $ligne["immatriculation"] . "' style='display:none;'>";
        echo "<img src='" . $image_path . "' alt='Image de voiture'>";
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
