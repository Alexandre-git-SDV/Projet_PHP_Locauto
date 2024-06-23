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
        <a href="page accueil.html"> <img src="locauto_remove.png" alt="image"> </a> <!-- Liste des vehicules disponible -->
        <div class="onglets">
            <a href="https://www.linkedin.com/in/mathis-huard/"> Contact / Support </a> <!-- Formulaire pour ajouter ou supprimer un client -->
            <link rel="stylesheet" href="stylephp.css"> <!-- Lien vers le fichier CSS -->
        </div>
    </nav>

    <h1>Menu : clients</h1>

    <h2>Rechercher un client</h2>
    <form action="client.php" method="get">
        <input type="text" name="nom_client" placeholder="Nom du client" required>
        <input type="submit" value="Rechercher">
    </form>

    <h2>Ajouter un client</h2>
    <form action="ajouter_client.php" method="post">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="text" name="adresse" placeholder="Adresse" required>
        <input type="number" name="id_type_de_client" placeholder="ID Type de Client" required>
        <input type="number" name="id_organisation" placeholder="ID Organisation" required>
        <input type="submit" value="Ajouter">
    </form>

    <h2>Consulter l'historique de location d'un client</h2>
    <form action="historique.php" method="get">
        <input type="text" name="nom_client" placeholder="Nom du client" required>
        <input type="submit" value="Consulter">
    </form>

    <h2>Louer une voiture</h2>
    <form action="louer_voiture.php" method="post">
        <input type="text" name="id_client" placeholder="ID Client" required>
        <input type="text" name="id_voiture" placeholder="ID Voiture" required>
        <input type="date" name="date_debut" placeholder="Date de début" required>
        <input type="date" name="date_fin" placeholder="Date de fin" required>
        <input type="number" name="compteur_debut" placeholder="Compteur début" required>
        <input type="submit" value="Louer">
    </form>

</body>
</html>
