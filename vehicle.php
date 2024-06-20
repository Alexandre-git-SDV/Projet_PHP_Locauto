<!DOCTYPE html>
<html>
<head>
    <!-- Barre de Navigation  -->
    <nav>
        <a href="page accueil.html"> <img src="locauto_remove.png" alt="image"> </a> <!-- Liste des véhicules disponibles -->
        <div class="onglets">
            <a href="#"> Contact / Support </a> <!-- Formulaire pour ajouter ou supprimer un client -->
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
    if (isset($_GET["immatriculation"])) {
        $immatriculation = $_GET["immatriculation"];
        try {
            $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');
            $requete = 'SELECT * FROM voiture WHERE immatriculation = :immatriculation';
            $stmt = $connexion->prepare($requete);
            $stmt->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR);
            $stmt->execute();
            while ($voiture = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id_modele = $voiture["id_modele"];
                
                $requete2 = 'SELECT * FROM modele WHERE id_modele = :id_modele';
                $stmt2 = $connexion->prepare($requete2);
                $stmt2->bindParam(':id_modele', $id_modele, PDO::PARAM_INT);
                $stmt2->execute();
                
                $modele = $stmt2->fetch(PDO::FETCH_ASSOC);
                $id_marque = $modele["id_marque"];

                $requete3 = 'SELECT * FROM marque WHERE id_marque = :id_marque';
                $stmt3 = $connexion->prepare($requete3);
                $stmt3->bindParam(':id_marque', $id_marque, PDO::PARAM_INT);
                $stmt3->execute();

                $marque = $stmt3->fetch(PDO::FETCH_ASSOC);
                $image_path = 'images/' . $modele["image"];

                $requete4 = 'SELECT * FROM categorie WHERE id_categorie = :id_categorie';
                $stmt4 = $connexion->prepare($requete4);
                $stmt4->bindParam(':id_categorie', $modele["id_categorie"], PDO::PARAM_INT);
                $stmt4->execute();

                $categorie = $stmt4->fetch(PDO::FETCH_ASSOC);
                
                echo "<div class='car-image'><img src='" . $image_path . "' alt='Image de voiture'></div>";
                echo "<table>\n";
                echo "\t<tr><th>Id Voiture</th><td>" . $voiture["id_voiture"] . "</td></tr>\n";
                echo "\t<tr><th>Immatriculation</th><td>" . $voiture["immatriculation"] . "</td></tr>\n";
                echo "\t<tr><th>Compteur</th><td>" . $voiture["compteur"] . "</td></tr>\n";
                echo "\t<tr><th>Modèle</th><td>" . $modele["libelle"] . "</td></tr>\n";
                echo "\t<tr><th>Marque</th><td>" . $marque["libelle"] . "</td></tr>\n";
                echo "\t<tr><th>Catégorie</th><td>" . $categorie["libelle"] . "</td></tr>\n";
                echo "\t<tr><th>Prix</th><td>" . $categorie["prix"] . "</td></tr>\n";
                echo "</table>";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage() . "<br/>";
            die();
        }
    } else {
        echo "Erreur : Immatriculation non spécifiée.";
    }
    ?>
    </div>
</body>
</html>
