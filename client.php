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
    <title>Détail du client</title>
    <link rel="stylesheet" href="stylephp.css"> <!-- Lien vers le fichier CSS -->
    <style>
        /* Inline CSS for the design */
        body {
            font-family: Arial, sans-serif;
            background-color: #94a9d7;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            margin: 0;
            flex-wrap: wrap;
            align-content: flex-start;
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

        .no-client {
            text-align: center;
            font-size: 18px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Détails du Client</h1>
        <?php
        try { 
            $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', ''); // Connexion à la base de données

            if (isset($_GET["nom_client"])) { // Vérifier si le nom du client est spécifié
                $nom_client = "%" . $_GET["nom_client"] . "%"; // Recherche partielle
                $requete = 'SELECT * FROM client WHERE nom LIKE :nom_client'; // Requête SQL pour récupérer les clients
                $stmt = $connexion->prepare($requete); // Préparation de la requête
                $stmt->bindParam(':nom_client', $nom_client, PDO::PARAM_STR); // Liaison des paramètres
                $stmt->execute(); // Exécution de la requête

                echo "<table>\n"; // Affichage des résultats sous forme de tableau
                // Entête du tableau 
                echo "\t<tr><th>ID Client</th><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Type de client</th><th>Organisation</th><th>Voiture Empruntée</th><th>Date Début</th><th>Date Fin</th><th>Compteur Début</th><th>Compteur Fin</th></tr>\n";
                while ($client = $stmt->fetch(PDO::FETCH_ASSOC)) { // Parcourir les résultats
                    echo "\t<tr>\n"; // Ligne du tableau
                    echo "\t\t<td>" . $client["id_client"] . "</td>\n"; // Affichage de l'ID du client
                    echo "\t\t<td>" . $client["nom"] . "</td>\n"; // Affichage du nom du client
                    echo "\t\t<td>" . $client["prenom"] . "</td>\n";  // Affichage du prénom du client
                    echo "\t\t<td>" . $client["adresse"] . "</td>\n"; // Affichage de l'adresse du client

                    $id_type_de_client = $client["id_type_de_client"]; // Récupérer l'ID du type de client

                    $requete2 = 'SELECT * FROM type_de_client WHERE id_type_de_client = :id_type_de_client'; // Requête SQL pour récupérer le type de client
                    $stmt2 = $connexion->prepare($requete2); // Préparation de la requête
                    $stmt2->bindParam(':id_type_de_client', $id_type_de_client, PDO::PARAM_INT); // Liaison des paramètres
                    $stmt2->execute(); // Exécution de la requête
                    $type_de_client = $stmt2->fetch(PDO::FETCH_ASSOC); // Récupération du type de client

                    echo "\t\t<td>" . $type_de_client["libelle"] . "</td>\n"; // Affichage du type de client

                    $requete3 = 'SELECT organisation.nom FROM organisation
                                JOIN appartient_a ON organisation.id_organisation = appartient_a.id_organisation
                                WHERE appartient_a.id_client = :id_client'; // Requête SQL pour récupérer l'organisation du client
                    $stmt3 = $connexion->prepare($requete3); // Préparation de la requête
                    $stmt3->bindParam(':id_client', $client["id_client"], PDO::PARAM_INT); // Liaison des paramètres
                    $stmt3->execute(); // Exécution de la requête
                    $organisation = $stmt3->fetch(PDO::FETCH_ASSOC); // Récupération de l'organisation

                    echo "\t\t<td>" . $organisation["nom"] . "</td>\n"; // Affichage de l'organisation

                    $requete4 = 'SELECT location.date_debut, location.date_fin, location.compteur_debut, location.compteur_fin, voiture.immatriculation 
                                FROM location 
                                JOIN voiture ON location.id_voiture = voiture.id_voiture
                                WHERE location.id_client = :id_client'; // Requête SQL pour récupérer les locations du client
                    $stmt4 = $connexion->prepare($requete4); // Préparation de la requête
                    $stmt4->bindParam(':id_client', $client["id_client"], PDO::PARAM_INT); // Liaison des paramètres
                    $stmt4->execute(); // Exécution de la requête
                    $location = $stmt4->fetch(PDO::FETCH_ASSOC); // Récupération de la location

                    if ($location) { // Vérifier si le client a loué une voiture
                        echo "\t\t<td>" . $location["immatriculation"] . "</td>\n"; // Affichage de l'immatriculation de la voiture
                        echo "\t\t<td>" . $location["date_debut"] . "</td>\n"; // Affichage de la date de début de la location
                        echo "\t\t<td>" . $location["date_fin"] . "</td>\n";  // Affichage de la date de fin de la location
                        echo "\t\t<td>" . $location["compteur_debut"] . "</td>\n"; // Affichage du compteur de début
                        echo "\t\t<td>" . $location["compteur_fin"] . "</td>\n"; // Affichage du compteur de fin
                    } else {   // Si le client n'a pas loué de voiture
                        echo "\t\t<td colspan='5'>Pas encore loué de voiture</td>\n"; // Message d'information
                    }

                    echo "\t</tr>\n"; // Fin de la ligne du tableau
                }
                echo "</table>"; // Fin du tableau
            } else {
                echo "<div class='no-client'>Nom du client non spécifié.</div>"; // Message d'erreur si le nom du client n'est pas spécifié
            }
        } catch (PDOException $e) { // Gestion des exceptions
            echo "<div class='no-client'>Erreur : " . $e->getMessage() . "</div>"; // Affichage de l'erreur
        }
        ?>
    </div>
</body>
</html>
