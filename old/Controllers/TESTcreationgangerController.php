<?php

session_start();

$dsn = 'mysql:dbname=web;host=127.0.0.1';
$user = 'web';
$password = 'ceciestunmotdepassesecurise';
try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

require '../Tables/personnage.php';
require '../Managers/personnageManager.php';
require '../Tables/gang.php';
require '../Managers/gangManager.php';

if (isset($_POST['nompersonnage']) && isset($_SESSION['gangs'][$_POST['numgang']]['Id_Gang']) && isset($_POST['typepersonnage']) && isset($_POST['prixpersonnage'])) {
    $numerogang = $_POST['numgang'];
    $idgang = $_SESSION['gangs'][$numerogang]['Id_Gang'];

    $gangManager = new gangManager($dbh);
    $g = $gangManager->getGangById($idgang);

    $gang = new gang($g['Id_Gang'], $g['nom_Gang'], $g['maison_Gang'], $g['valeur_Gang'], $g['reputation_Gang'], $g['tailleTerritoire_Gang'], $g['magot_Gang'], $g['Id_Utilisateur'], 8);

    $prix = $_POST['prixpersonnage'];
    $magot = $gang->getMagot();

    if (true) {

        $gang->acheter($prix);
        $gangManager->updateMagot($gang);

        $nom = $_POST['nompersonnage'];
        $mouvement = $_POST['mpersonnage'];
        $capacitedecorpsacorps = $_POST['ccersonnage'];
        $capacitedetir = $_POST['ctpersonnage'];
        $force = $_POST['fpersonnage'];
        $endurance = $_POST['epersonnage'];
        $pointdevie = $_POST['pvpersonnage'];
        $initiative = $_POST['ipersonnage'];
        $attaque = $_POST['apersonnage'];
        $commandement = $_POST['cdpersonnage'];
        $sangfroid = $_POST['sfpersonnage'];
        $volonte = $_POST['versonnage'];
        $intelligence = $_POST['intpersonnage'];
        $type = $_POST['typepersonnage'];


        $personnage = new personnage(0, $nom, 0, 0, $mouvement, $capacitedecorpsacorps, $capacitedetir, $force, $endurance, $pointdevie, $initiative, $attaque, $commandement, $sangfroid, $volonte, $intelligence, 0, 0, $type, $idgang, 20);
        $personnageManager = new personnageManager($dbh);
        $personnageManager->add($personnage);

        echo "Success";
    } else {
        echo "Erreur";
    }
} else {
    echo "Failed";
}
?>
