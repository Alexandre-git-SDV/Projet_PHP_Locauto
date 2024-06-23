<!DOCTYPE html>
<html>
<head>
    <!-- Barre de Navigation  -->
    <nav>
        <a href="page accueil.html"> <img src="locauto_remove.png" alt="image"> </a> 
        <div class="onglets">
            <a href="#"> Contact / Support </a> 
        </div>
    </nav>

    <title>Détails du Véhicule</title>
    <link rel="stylesheet" href="stylephp.css"> <!-- Lien vers le fichier CSS -->
    <style>
        /* Inline CSS for the design */
        body {
            font-family: Arial, sans-serif;
            background-color: #94a9d7;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        .car-details {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .car-image {
            max-width: 300px;
            margin-bottom: 20px;
        }

        .car-image img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <h1>Détails du Véhicule</h1> 
    <div class="car-details"> 
    <?php
    if (isset($_GET["immatriculation"])) { // Si l'immatriculation est spécifiée
        $immatriculation = $_GET["immatriculation"]; // Récupérer l'immatriculation
        try { 
            $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', ''); // Connexion à la base de données
            $requete = 'SELECT * FROM voiture WHERE immatriculation = :immatriculation'; // Requête SQL pour récupérer les informations de la voiture
            $stmt = $connexion->prepare($requete); // Préparation de la requête
            $stmt->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR); // Liaison du paramètre
            $stmt->execute(); // Exécution de la requête 
            while ($voiture = $stmt->fetch(PDO::FETCH_ASSOC)) { // Parcourir les résultats
                $id_modele = $voiture["id_modele"]; // Récupérer l'ID du modèle de la voiture
                
                $requete2 = 'SELECT * FROM modele WHERE id_modele = :id_modele'; // Requête SQL pour récupérer les informations du modèle
                $stmt2 = $connexion->prepare($requete2); // Préparation de la requête
                $stmt2->bindParam(':id_modele', $id_modele, PDO::PARAM_INT); // Liaison du paramètre
                $stmt2->execute(); // Exécution de la requête
                
                $modele = $stmt2->fetch(PDO::FETCH_ASSOC); // Récupérer les informations du modèle
                $id_marque = $modele["id_marque"]; // Récupérer l'ID de la marque du modèle

                $requete3 = 'SELECT * FROM marque WHERE id_marque = :id_marque'; // Requête SQL pour récupérer les informations de la marque
                $stmt3 = $connexion->prepare($requete3); // Préparation de la requête
                $stmt3->bindParam(':id_marque', $id_marque, PDO::PARAM_INT); // Liaison du paramètre
                $stmt3->execute(); // Exécution de la requête

                $marque = $stmt3->fetch(PDO::FETCH_ASSOC); // Récupérer les informations de la marque
                $image_path = 'images/' . $modele["image"]; // Chemin de l'image du modèle

                $requete4 = 'SELECT * FROM categorie WHERE id_categorie = :id_categorie'; // Requête SQL pour récupérer les informations de la catégorie
                $stmt4 = $connexion->prepare($requete4); // Préparation de la requête
                $stmt4->bindParam(':id_categorie', $modele["id_categorie"], PDO::PARAM_INT); // Liaison du paramètre
                $stmt4->execute(); // Exécution de la requête

                $categorie = $stmt4->fetch(PDO::FETCH_ASSOC); // Récupérer les informations de la catégorie
                
                echo "<div class='car-image'><img src='" . $image_path . "' alt='Image de voiture'></div>"; // Afficher l'image de la voiture
                echo "<table>\n"; // Début du tableau
                echo "\t<tr><th>Id Voiture</th><td>" . $voiture["id_voiture"] . "</td></tr>\n"; // Afficher l'ID de la voiture
                echo "\t<tr><th>Immatriculation</th><td>" . $voiture["immatriculation"] . "</td></tr>\n"; // Afficher l'immatriculation
                echo "\t<tr><th>Compteur</th><td>" . $voiture["compteur"] . "</td></tr>\n"; // Afficher le compteur
                echo "\t<tr><th>Modèle</th><td>" . $modele["libelle"] . "</td></tr>\n"; // Afficher le modèle
                echo "\t<tr><th>Marque</th><td>" . $marque["libelle"] . "</td></tr>\n"; // Afficher la marque
                echo "\t<tr><th>Catégorie</th><td>" . $categorie["libelle"] . "</td></tr>\n"; // Afficher la catégorie
                echo "\t<tr><th>Prix</th><td>" . $categorie["prix"] . "</td></tr>\n"; // Afficher le prix
                echo "</table>"; // Fin du tableau
            }
        } catch (PDOException $e) { // Gestion des exceptions
            echo "Erreur : " . $e->getMessage() . "<br/>"; // Afficher le message d'erreur
            die(); // Arrêter le script
        }
    } else { // Si l'immatriculation n'est pas spécifiée
        echo "Erreur : Immatriculation non spécifiée."; // Afficher un message d'erreur 
    }
    ?>
    </div>
</body>
</html>
