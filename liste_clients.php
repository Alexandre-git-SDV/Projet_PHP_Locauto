<!DOCTYPE html>
<html>
<head>
    <title>Liste des clients</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d3d3e6; /* Light blue background */
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #ffffff; /* White background */
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
            text-align: center;
        }

        nav a {
            margin: 0 15px;
            color: #333;
            text-decoration: none;
            font-size: 18px;
        }

        nav img {
            height: 40px;
            vertical-align: middle;
        }

        .onglets a {
            color: #0073b1; /* LinkedIn blue color */
        }

        h1 {
            color: #333;
            text-align: center;
            padding: 20px 0;
        }

        h2 {
            color: #333;
            text-align: center;
            padding: 10px 0;
        }

        form {
            text-align: center;
            margin: 20px 0;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            padding: 10px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 200px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #0073b1; /* LinkedIn blue color */
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #005f8c; /* Darker blue */
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        table th {
            background-color: #f4f4f4;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <nav>
        <a href="page accueil.html"> <img src="locauto_remove.png" alt="image"> </a>
        <div class="onglets">
            <a href="https://www.linkedin.com/in/mathis-huard/"> Contact / Support </a> 
            <link rel="stylesheet" href="stylephp.css"> <!-- Lien vers le fichier CSS -->
        </div>
    </nav>

    <h1>Menu : clients</h1>

    <h2>Rechercher un client</h2>  <!-- Section pour rechercher un client  --> 
    <form action="client.php" method="get"> <!-- Formulaire pour rechercher un client -> client.php -->
        <input type="text" name="nom_client" placeholder="Nom du client" required> <!-- Champ pour entrer le nom du client -->
        <input type="submit" value="Rechercher"> <!-- Bouton pour rechercher le client -->
    </form>

    <h2>Ajouter un client</h2> <!-- Section pour ajouter un client -->
    <form action="ajouter_client.php" method="post"> <!-- Formulaire pour ajouter un client -> ajouter_client.php -->
        <input type="text" name="nom" placeholder="Nom" required> <!-- Champ pour entrer le nom du client -->
        <input type="text" name="prenom" placeholder="Prénom" required> <!-- Champ pour entrer le prénom du client -->
        <input type="text" name="adresse" placeholder="Adresse" required> <!-- Champ pour entrer l'adresse du client -->
        <input type="number" name="id_type_de_client" placeholder="ID Type de Client" required> <!-- Champ pour entrer l'ID du type de client -->
        <input type="number" name="id_organisation" placeholder="ID Organisation" required> <!-- Champ pour entrer l'ID de l'organisation -->
        <input type="submit" value="Ajouter"> <!-- Bouton pour ajouter le client -->
    </form>

    <h2>Consulter l'historique de location d'un client</h2> <!-- Section pour consulter l'historique de location d'un client -->
    <form action="historique.php" method="get"> <!-- Formulaire pour consulter l'historique de location d'un client -> historique.php -->
        <input type="text" name="nom_client" placeholder="Nom du client" required> <!-- Champ pour entrer le nom du client -->
        <input type="submit" value="Consulter"> <!-- Bouton pour consulter l'historique de location d'un client -->
    </form>

    <h2>Louer une voiture</h2> <!-- Section pour louer une voiture -->
    <form action="louer_voiture.php" method="post"> <!-- Formulaire pour louer une voiture -> louer_voiture.php -->
        <input type="text" name="id_client" placeholder="ID Client" required> <!-- Champ pour entrer l'ID du client -->
        <input type="text" name="id_voiture" placeholder="ID Voiture" required> <!-- Champ pour entrer l'ID de la voiture -->
        <input type="date" name="date_debut" placeholder="Date de début" required> <!-- Champ pour entrer la date de début de la location -->
        <input type="date" name="date_fin" placeholder="Date de fin" required> <!-- Champ pour entrer la date de fin de la location -->
        <input type="number" name="compteur_debut" placeholder="Compteur début" required> <!-- Champ pour entrer le compteur de début de la location -->
        <input type="submit" value="Louer"> <!-- Bouton pour louer la voiture -->
    </form> 

</body>
</html>
