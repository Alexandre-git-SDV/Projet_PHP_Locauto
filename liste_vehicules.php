<!DOCTYPE html>
<html>
<head>
    <!-- Barre de Navigation  -->
    <nav>
        <a href="page accueil.html"> <img src="locauto_remove.png" alt="image"> </a> <!-- Liste des vehicules disponible -->
        <div class="onglets">
            <a href="https://www.linkedin.com/in/mathis-huard/"> Contact / Support </a> <!-- Formulaire pour ajouter ou supprimer un client -->
        </div>
    </nav>
    <title>Liste des véhicules</title>
    <link rel="stylesheet" href="stylephp.css"> <!-- Lien vers le fichier CSS -->
    <style>
        /* Zone de style pour le design */
        body {
            font-family: Arial, sans-serif;
        }

        h1 { /* Titre de la page*/
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        .wrapper { /* Conteneur pour les voitures */
            display: flex; /* Affichage en ligne */
            flex-wrap: wrap; /* Retour à la ligne si besoin */
            justify-content: center; /* Centrage horizontal */
            gap: 20px;
            margin: 20px;
        }

        .car-item { /* Style des voitures */
            border: 2px solid #ccc; /* Bordure grise */
            border-radius: 10px; /* Coins arrondis */
            padding: 10px; /* Espacement intérieur */
            text-align: center; /* Centrage du texte */
            width: 200px; /* Largeur fixe */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre */
            background-color: #fff; /* Fond blanc */
            transition: transform 0.3s, box-shadow 0.3s; /* Animation */
        }

        .car-item:hover { /* Style des voitures au survol */
            transform: translateY(-10px); /* Légère montée */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée */
        }

        .car-item img { /* Style des images */
            width: 100%; /* Largeur 100% */
            height: auto; /* Hauteur automatique */
            border-bottom: 1px solid #ccc; /* Bordure en bas */
            padding-bottom: 10px; /* Espacement en bas */
            margin-bottom: 10px; /* Marge en bas */
            cursor: pointer; /* Curseur main */
        }

        .car-item label { /* Style des libellés */
            display: block; /* Affichage en bloc */
            font-weight: bold; /* Texte en gras */
            margin-bottom: 10px; /* Marge en bas */
        }

        input[type="submit"] { /* Style du bouton */
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #0044cc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer; /* Curseur main */
            transition: background-color 0.3s; /* Animation */
        }

        input[type="submit"]:hover { /* Style du bouton au survol */
            background-color: #0033aa;
        }

        .selected { /* Style de la voiture sélectionnée */
            border: 2px solid blue;
            box-shadow: 0 0 10px blue;
        }
    </style>
    <script>
        function selectCar(element) {
            // Suppression de la classe 'selected' de tous les éléments
            var items = document.getElementsByClassName('car-item');
            for (var i = 0; i < items.length; i++) {
                items[i].classList.remove('selected');
            }
            // Ajout de la classe 'selected' à l'élément cliqué
            element.classList.add('selected');
            // Cocher le bouton radio correspondant
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
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', ''); // Connexion à la base de données
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
