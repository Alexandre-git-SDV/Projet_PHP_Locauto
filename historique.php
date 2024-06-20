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
<!DOCTYPE html>
<html>
<head>
    <style>
        /* Inline CSS for the design */
        body {
            font-family: Arial, sans-serif;
            background-color: #94a9d7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
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
            margin: 0 auto 20px auto;
        }

        .car-image img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .no-client {
            text-align: center;
            font-size: 18px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Détails du Véhicule</h1>
<!--         <div class="car-image">
            <img src="path_to_car_image.jpg" alt="Image de voiture">
        </div> -->
        <?php
        try {
            $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');

            if (isset($_GET["nom_client"])) {
                $nom_client = $_GET["nom_client"];
                $requete = 'SELECT c.id_client, c.nom, c.prenom, l.date_debut, l.date_fin, l.compteur_debut, l.compteur_fin, v.immatriculation 
                            FROM client c
                            LEFT JOIN location l ON c.id_client = l.id_client
                            LEFT JOIN voiture v ON l.id_voiture = v.id_voiture
                            WHERE c.nom LIKE :nom_client';
                $stmt = $connexion->prepare($requete);
                $nom_client = "%" . $nom_client . "%";
                $stmt->bindParam(':nom_client', $nom_client, PDO::PARAM_STR);
                $stmt->execute();

                $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($locations) > 0) {
                    echo "<table>\n";
                    echo "\t<tr><th>ID Client</th><th>Nom</th><th>Prénom</th><th>Date Début</th><th>Date Fin</th><th>Compteur Début</th><th>Compteur Fin</th><th>Immatriculation Voiture</th></tr>\n";
                    foreach ($locations as $location) {
                        echo "\t<tr>\n";
                        echo "\t\t<td>" . $location["id_client"] . "</td>\n";
                        echo "\t\t<td>" . $location["nom"] . "</td>\n";
                        echo "\t\t<td>" . $location["prenom"] . "</td>\n";
                        if ($location["date_debut"]) {
                            echo "\t\t<td>" . $location["date_debut"] . "</td>\n";
                            echo "\t\t<td>" . $location["date_fin"] . "</td>\n";
                            echo "\t\t<td>" . $location["compteur_debut"] . "</td>\n";
                            echo "\t\t<td>" . $location["compteur_fin"] . "</td>\n";
                            echo "\t\t<td>" . $location["immatriculation"] . "</td>\n";
                        } else {
                            echo "\t\t<td colspan='5'>Pas encore loué de voiture</td>\n";
                        }
                        echo "\t</tr>\n";
                    }
                    echo "</table>";
                } else {
                    echo "<div class='no-client'>Aucun client trouvé avec ce nom.</div>";
                }
            } else {
                echo "<div class='no-client'>Nom du client non spécifié.</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='no-client'>Erreur : " . $e->getMessage() . "</div>";
        }
        ?>
    </div>
</body>
</html>
