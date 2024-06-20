<?php
try {
    $connexion = new PDO('mysql:host=localhost;dbname=locauto', 'root', '');

    if (isset($_GET["immatriculation"])) {
        $immatriculation = $_GET["immatriculation"];
        $requete = 'UPDATE voiture SET archive = 1 WHERE immatriculation = :immatriculation';
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':immatriculation', $immatriculation, PDO::PARAM_STR);
        $stmt->execute();

        echo "Voiture archivée avec succès. <a href='liste_vehicules.php'>Retour</a>";
    } else {
        echo "Erreur : immatriculation non fournie.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
}
?>
