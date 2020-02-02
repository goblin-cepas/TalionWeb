<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



include dirname(__DIR__) . '/Tools/connexionBdd.php';
include dirname(__DIR__) . '/Tables/theme.php';
include dirname(__DIR__) . '/Tables/lieu.php';
include dirname(__DIR__) . '/Tables/evenement.php';
include dirname(__DIR__) . '/Managers/themeManager.php';
include dirname(__DIR__) . '/Managers/lieuManager.php';
include dirname(__DIR__) . '/Managers/evenementManager.php';

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$themeManager = new themeManager($dbh);
$eventManager = new evenementManager($dbh);

$themeArrayEvent = $themeManager->selectAll();
$eventArray = $eventManager->selectAll();



if(isset($_POST['nomEvent']) && isset($_POST['VilleEvent']) && isset($_POST['Rue']) && isset($_POST['Date']) && isset($_POST['NumRue']) && isset($_POST['CodePostal']) && isset($_POST['effectifMin']) && isset($_POST['effectifMax']) && isset($_POST['Long']) && isset($_POST['Lat'])  && isset($_POST['Description'])) {

$eventManager = new evenementManager($dbh);
$lieuManager = new lieuManager($dbh);



$nomEvent = $_POST['nomEvent'];
$ville = $_POST['VilleEvent'];
$rue = $_POST['Rue'];
$date = date('Y-m-d',strtotime($_POST['Date']));
$numRue = $_POST['NumRue'];
$codePostal = $_POST['CodePostal'];
$effectifMin = $_POST['effectifMin'];
$effectifMax = $_POST['effectifMax'];
$longitude = $_POST['Long'];
$latitude = $_POST['Lat'];
$theme = $_POST['theme'];
$description = $_POST['Description'];

$lieu = new lieu(0,$ville,$rue,$numRue,$codePostal,$longitude,$latitude,8);
$lieuManager->add($lieu);
$idlieu = $lieuManager->selectByNom($rue,$codePostal,$numRue,$ville);
$idcontrib = 1;

$evenement = new evenement(0,$nomEvent,$date,$effectifMin,$effectifMax,$idcontrib,1,$idlieu,$description,date("Y-m-d"),2);
$eventManager->add($evenement);

header("refresh:1;  url=../index.php?page=map");
}

?>
