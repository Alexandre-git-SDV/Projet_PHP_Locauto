<!DOCTYPE html>
<html>
<head>
<title>Liste des clients</title>
</head>
<body> 
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

