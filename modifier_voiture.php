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
    <title>Modifier Voiture</title>
    <link rel="stylesheet" href="stylephp.css"> <!-- Lien vers le fichier CSS -->
<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');

    if (isset($_GET["immatriculation"])) {
        $immatriculation = $_GET["immatriculation"];
        $requete = 'SELECT * FROM voiture WHERE immatriculation = :immatriculation';
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR);
        $stmt->execute();
        $voiture = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($voiture) {
            echo "<h1>Modifier voiture</h1>";
            echo "<form action='modifier_voiture.php' method='post'>";
            echo "<input type='hidden' name='immatriculation' value='" . $voiture["immatriculation"] . "'>";
            echo "Compteur: <input type='number' name='compteur' value='" . $voiture["compteur"] . "' required><br>";
            echo "ID Modèle: <input type='number' name='id_modele' value='" . $voiture["id_modele"] . "' required><br>";
            echo "<input type='submit' value='Modifier'>";
            echo "</form>";
        } else {
            echo "Erreur : Voiture non trouvée.";
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        $immatriculation = $_POST["immatriculation"];
        $compteur = $_POST["compteur"];
        $id_modele = $_POST["id_modele"];

        $requete = 'UPDATE voiture SET compteur = :compteur, id_modele = :id_modele WHERE immatriculation = :immatriculation';
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':compteur', $compteur, PDO::PARAM_INT);
        $stmt->bindParam(':id_modele', $id_modele, PDO::PARAM_INT);
        $stmt->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR);
        $stmt->execute();

        echo "Voiture modifiée avec succès.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
}
?>
</body>
</html>
