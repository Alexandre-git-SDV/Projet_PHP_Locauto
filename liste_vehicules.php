<!DOCTYPE html>
<html>
<head>
    <!-- Barre de Navigation  -->
    <nav>
        <a href="page accueil.html"> <img src="locauto_remove.png" alt="image"> </a> <!-- Liste des véhicules disponibles -->
        <div class="onglets">
            <a href="https://www.linkedin.com/in/mathis-huard/"> Contact / Support </a> <!-- Formulaire pour ajouter ou supprimer un client -->
        </div>
    </nav>
    <title>Liste des véhicules</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->
    <style>
        /* Zone de style pour le design */
        body {
            font-family: Arial, sans-serif;
            background-color: #94a9d7;
        }

        h1 { /* Titre de la page */
            text-align: center; /* Centrage horizontal */
            color: #333; /* Texte noir */
            margin-top: 20px; /* Marge en haut */
        }

        h2 { /* Titre de section */
            text-align: center; /* Centrage horizontal */
            color: #333; /* Texte noir */
            margin-top: 20px; /* Marge en haut */
        }

        .wrapper { /* Conteneur pour les voitures */
            display: flex; /* Affichage en ligne */
            flex-wrap: wrap; /* Retour à la ligne si besoin */
            justify-content: center; /* Centrage horizontal */
            gap: 20px; /* Espacement entre les éléments */
            margin: 20px; /* Marge autour du conteneur */
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
            display: block; /* Affichage en bloc */
            margin: 20px auto; /* Marge autour du bouton */
            padding: 10px 20px; /* Espacement intérieur */
            font-size: 16px; /* Taille de police */
            background-color: #0044cc; /* Couleur de fond */
            color: white; /* Texte blanc */
            border-color: black; /* Bordure noire */
            border-style: solid; /* Bordure pleine */
            border-radius: 5px; /* Coins arrondis */
            cursor: pointer; /* Curseur main */
            transition: background-color 0.3s; /* Animation */
        }

        input[type="submit"]:hover { /* Style du bouton au survol */
            background-color: #91aeff; /* Couleur de fond plus claire */
        }

        .selected { /* Style de la voiture sélectionnée */
            border: 2px solid blue; /* Bordure bleue */
            box-shadow: 0 0 10px blue;  /* Ombre bleue */
        }

        form { /* Formulaire pour ajouter un véhicule */
            text-align: center; /* Centrage horizontal */
            margin-top: 20px; /* Marge en haut */
        }

        .vehicle-form input[type="text"], /* Style des champs de texte */
        .vehicle-form input[type="number"] { /* Style des champs numériques */
            margin: 5px; /* Marge autour des champs */
            padding: 10px; /* Espacement intérieur */
            font-size: 16px; /* Taille de police */
            border-radius: 5px; /* Coins arrondis */
            border: 1px solid #ccc; /* Bordure grise */
            width: 200px;   /* Largeur fixe */
        }

        .vehicle-form input[type="submit"] { /* Style du bouton */
            background-color: #0044cc; /* Couleur de fond */
            color: white; /* Texte blanc */
            border-color: black; /* Bordure noire */
            border-style: solid; /* Bordure pleine */
            border-radius: 5px; /* Coins arrondis */
            cursor: pointer; /* Curseur main */
            transition: background-color 0.3s; /* Animation */
        }

        .vehicle-form input[type="submit"]:hover { /* Style du bouton au survol */
            background-color: #91aeff; /* Couleur de fond plus claire */
        }

    </style>
</head>
<body> 
<h1>Menu : véhicules</h1>
<h1>Choisissez un véhicule :</h1>
<form action="vehicle.php" method="get" id="vehicleForm">
    <div class="wrapper"> <!-- Conteneur pour les voitures -->
        <?php
        try { // Connexion à la base de données
            $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', ''); // Connexion à la base de données
            $requete = 'SELECT voiture.immatriculation, modele.image, modele.libelle, voiture.archive  
                        FROM voiture JOIN modele ON voiture.id_modele = modele.id_modele'; // Requête SQL pour récupérer les informations des voitures
            $resultat = $connexion->query($requete); // Exécution de la requête
            while ($ligne = $resultat->fetch()) { // Parcours des lignes de résultat
                $image_path = 'images/' . $ligne["image"]; // Chemin de l'image
                echo "<div class='car-item'>"; // Début de la div pour la voiture
                echo "<label>" . $ligne["libelle"] . "</label>"; // Libellé du modèle
                echo "<input type='radio' name='immatriculation' value='" . $ligne["immatriculation"] . "' style='display:none;' id='car_" . $ligne["immatriculation"] . "'>";
                echo "<img src='" . $image_path . "' alt='Image de voiture' onclick='selectCar(\"car_" . $ligne["immatriculation"] . "\")'>";
                echo "<a href='modifier_voiture.php?immatriculation=" . $ligne["immatriculation"] . "'>Modifier</a><br>";
                if ($ligne["archive"] == 0) { // Si la voiture n'est pas archivée
                    echo "<a href='archiver_voiture.php?immatriculation=" . $ligne["immatriculation"] . "'>Archiver</a><br>";
                } else { // Si la voiture est archivée
                    echo "<span>Archivé</span><br>";
                } // Fin de la condition
                echo "</div>";
            }
        } catch (PDOException $e) { // Gestion des erreurs
            echo "Erreur : " . $e->getMessage() . "<br/>";
            die(); // Arrêt du script
        }
        ?>
    </div> <!-- Fin du conteneur pour les voitures -->
    <p><input type="submit" value="OK"></p>
</form>

<h2>Ajouter un véhicule</h2> <!-- Titre de section -->
<form class="vehicle-form" action="ajouter_voiture.php" method="post"> <!-- Formulaire pour ajouter un véhicule -->
    <input type="text" name="immatriculation" placeholder="Immatriculation" required>   <!-- Champ pour l'immatriculation -->
    <input type="number" name="compteur" placeholder="Compteur" required> <!-- Champ pour le compteur --> 
    <input type="number" name="id_modele" placeholder="ID Modèle" required> <!-- Champ pour l'ID du modèle -->
    <input type="submit" value="Ajouter"> <!-- Bouton pour ajouter -->
</form>

<script>
function selectCar(id) { // Fonction pour sélectionner une voiture
    var elements = document.querySelectorAll('.car-item');
    elements.forEach(function(element) { // Parcours des éléments
        element.classList.remove('selected'); // Suppression de la classe 'selected'
    }); // Fin de la boucle
    var selectedElement = document.getElementById(id).parentElement; // Élément parent de l'élément sélectionné
    selectedElement.classList.add('selected'); // Ajout de la classe 'selected'
    document.getElementById(id).checked = true; // Cocher l'élément sélectionné
}
</script>

</body>
</html>
