<!DOCTYPE html>
<html>
<head>
    <!-- Barre de Navigation  -->
    <nav>
        <a href="page accueil.html"> <img src="locauto_remove.png" alt="image"> </a> 
        <div class="onglets">
            <a href="https://www.linkedin.com/in/mathis-huard/"> Contact / Support </a>
        </div>
    </nav>
    <title>Liste des véhicules</title>
    <link rel="stylesheet" href="stylephp.css"> <!-- Lien vers le fichier CSS -->
    <style>
        /* Zone de style pour le design */
        body {
            font-family: Arial, sans-serif;
            background-color: #94a9d7;
        }

        h1 { /* Titre de la page */
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        h2 {
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
            border-color: black;
            border-style: solid;
            border-radius: 5px;
            cursor: pointer; /* Curseur main */
            transition: background-color 0.3s; /* Animation */
        }

        input[type="submit"]:hover { /* Style du bouton au survol */
            background-color: #91aeff;
        }

        .selected { /* Style de la voiture sélectionnée */
            border: 2px solid blue;
            box-shadow: 0 0 10px blue;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        .vehicle-form input[type="text"],
        .vehicle-form input[type="number"] {
            margin: 5px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 200px;
        }

        .vehicle-form input[type="submit"] {
            background-color: #0044cc;
            color: white;
            border-color: black;
            border-style: solid;
            border-radius: 5px;
            cursor: pointer; /* Curseur main */
            transition: background-color 0.3s; /* Animation */
        }

        .vehicle-form input[type="submit"]:hover {
            background-color: #91aeff;
        }

    </style>
</head>
<body> 
<h1>Menu : véhicules</h1>
<h1>Choisissez un véhicule :</h1> <!-- Affichez les véhicules disponibles -->
<form action="vehicle.php" method="get" id="vehicleForm"> <!-- Lorsqu'un véhicule est sélectionné, redirigez l'utilisateur vers la page vehicle.php -->
    <div class="wrapper">
        <?php
        try {
            $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', ''); // Connexion à la base de données
            $requete = 'SELECT voiture.immatriculation, modele.image, modele.libelle, voiture.archive 
                        FROM voiture JOIN modele ON voiture.id_modele = modele.id_modele'; // Requête SQL pour récupérer les informations des véhicules
            $resultat = $connexion->query($requete); // Exécution de la requête
            while ($ligne = $resultat->fetch()) { // Parcours des lignes de résultat
                $image_path = 'images/' . $ligne["image"]; // Chemin de l'image du véhicule
                echo "<div class='car-item'>"; 
                echo "<label>" . $ligne["libelle"] . "</label>";
                echo "<input type='radio' name='immatriculation' value='" . $ligne["immatriculation"] . "' style='display:none;' id='car_" . $ligne["immatriculation"] . "'>";
                echo "<img src='" . $image_path . "' alt='Image de voiture' onclick='selectCar(\"car_" . $ligne["immatriculation"] . "\")'>";
                echo "<a href='modifier_voiture.php?immatriculation=" . $ligne["immatriculation"] . "'>Modifier</a><br>";
                if ($ligne["archive"] == 0) { // Vérification si le véhicule est archivé
                    echo "<a href='archiver_voiture.php?immatriculation=" . $ligne["immatriculation"] . "'>Archiver</a><br>"; // Lien pour archiver le véhicule
                } else {
                    echo "<span>Archivé</span><br>"; // Affichage du statut archivé
                }
                echo "</div>";
            }
        } catch (PDOException $e) { // Gestion des exceptions
            echo "Erreur : " . $e->getMessage() . "<br/>"; // Affichage du message d'erreur
            die(); // Arrêt du script
        }
        ?>
    </div>
    <p><input type="submit" value="OK"></p> <!-- Bouton de validation --> 
</form>

<h2>Ajouter un véhicule</h2> <!-- Formulaire pour ajouter un véhicule -->
<form class="vehicle-form" action="ajouter_voiture.php" method="post"> <!-- Lorsqu'un véhicule est ajouté, redirigez l'utilisateur vers la page ajouter_voiture.php -->
    <input type="text" name="immatriculation" placeholder="Immatriculation" required> <!-- Champ pour l'immatriculation -->
    <input type="number" name="compteur" placeholder="Compteur" required> <!-- Champ pour le compteur -->
    <input type="number" name="id_modele" placeholder="ID Modèle" required> <!-- Champ pour l'ID du modèle -->
    <input type="submit" value="Ajouter">  <!-- Bouton pour ajouter le véhicule -->
</form>

<script>
function selectCar(id) { 
    var elements = document.querySelectorAll('.car-item');
    elements.forEach(function(element) {
        element.classList.remove('selected');
    });
    var selectedElement = document.getElementById(id).parentElement;
    selectedElement.classList.add('selected');
    document.getElementById(id).checked = true;
}
</script>

</body>
</html>
