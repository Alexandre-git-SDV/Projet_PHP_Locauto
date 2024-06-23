<!DOCTYPE html>
<html>
<head>
    <title>Liste des clients</title>
    <style>
        body {
            font-family: Arial, sans-serif;  /* Police de caractère */
            background-color: #94a9d7; /* Fond de Couleur bleu */
            margin: 0; /* Suppression des marges */
            padding: 0; /* Suppression des paddings */
        }
        nav { /* Barre de navigation */
            background-color: #ffffff; /* White background */
            border-bottom: 1px solid #ccc; /* Bordure grise en bas */
            padding: 10px 0; /* Espacement intérieur */
            text-align: center; /* Centrage du texte */
        }
        nav a { /* Liens de la barre de navigation */
            margin: 0 15px; /* Marge entre les liens */
            color: #333; /* Texte noir */
            text-decoration: none; /* Pas de soulignement */
            font-size: 18px; /* Taille de la police */
        }
        nav img { /* Logo de la barre de navigation */
            height: 40px; /* Hauteur du logo */
            vertical-align: middle; /* Alignement vertical */
        }
        .onglets a { /* Liens des onglets */
            color: #0073b1;
        } 
        h1 { /* Titre de la page */
            color: #333; /* Texte noir */
            text-align: center; /* Centrage horizontal */
            padding: 20px 0;  /* Espacement intérieur */
        }
        h2 { /* Titre de section */
            color: #333; /* Texte noir */
            text-align: center; /* Centrage horizontal */
            padding: 10px 0; /* Espacement intérieur */
        }
        form { /* Formulaire */
            text-align: center; /* Centrage horizontal */
            margin: 20px 0; /* Marge en haut et en bas */
        }
        input[type="text"],
        input[type="number"],
        input[type="date"] {
            padding: 10px; /* Espacement intérieur */
            margin: 5px; /* Marge autour de l'élément */
            border: 1px solid #ccc; /* Bordure grise */
            border-radius: 4px; /* Coins arrondis */
            width: 200px; /* Largeur fixe */
        }
        input[type="submit"] { /* Bouton de soumission */
            padding: 10px 20px; /* Espacement intérieur */
            background-color: #0073b1;
            border: none; /* Pas de bordure */
            color: white; /* Texte blanc */
            border-radius: 4px; /* Coins arrondis */
            cursor: pointer; /* Curseur main */
        }
        input[type="submit"]:hover { /* Bouton de soumission au survol */
            background-color: #005f8c;
        }
        table { /* Tableau */
            width: 80%; /* Largeur du tableau */
            margin: 20px auto; /* Marge autour du tableau */
            border-collapse: collapse; /* Fusion des bordures */
            background-color: white; /* Fond blanc */
            border: 1px solid #ccc; /* Bordure grise */
            border-radius: 8px; /* Coins arrondis */
            overflow: hidden; /* Masquer le contenu débordant */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table th,
        table td { /* Cellules d'en-tête et de données */
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        table th { /* Cellules d'en-tête */
            background-color: #94a9d7; /* Fond gris clair */
        }
        table tr:hover {
            background-color: #94a9d7;
        }
    </style>
</head>
<body>
    <nav>
        <a href="page accueil.html"> <img src="locauto_remove.png" alt="image"> </a> <!-- Liste des vehicules disponible -->
        <div class="onglets">
            <a href="https://www.linkedin.com/in/mathis-huard/"> Contact / Support </a> <!-- Formulaire pour ajouter ou supprimer un client -->
            <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS -->

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