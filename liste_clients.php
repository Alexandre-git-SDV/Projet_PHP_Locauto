<!DOCTYPE html>
<html>
<head>
<title>Liste des clients</title>
</head>
<body> 
<h1>Liste des clients</h1>

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

</body>
</html>
