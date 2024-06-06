<!DOCTYPE html>
<html>
<head>
<title>Liste des clients</title>
</head>
<body> 
<h1>Liste des clients</h1>
<p>Choisissez un client :</p>
<form action="client.php" method="get">
<div>
<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');
    $requete = 'SELECT id_client, nom FROM client';
    $resultat = $connexion->query($requete);
    while ($ligne = $resultat->fetch()) {
        echo "<label style='display:inline-block; text-align:center; margin:10px;'>";
        echo "<input type='radio' name='id_client' value='" . $ligne["id_client"] . "' style='display:none;'>";
        echo $ligne["nom"];
        echo "</label>";    
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
}
?>
</div>
<p><input type="submit" value="OK"></p>
</form>

<h2>Rechercher un client</h2>
<form action="client.php" method="get">
    <input type="text" name="nom_client" placeholder="Nom du client" required>
    <input type="submit" value="Rechercher">
</form>

</body>
</html>


