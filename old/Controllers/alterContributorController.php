<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include dirname(__DIR__) . '/Tools/connexionBdd.php';
include dirname(__DIR__) . '/Tables/contributeur.php';
include dirname(__DIR__) . '/Managers/contributeurManager.php';
include dirname(__DIR__) . '/Tables/visiteur.php';
include dirname(__DIR__) . '/Managers/visiteurManager.php';

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$contributeurManager = new contributeurManager($dbh);
$visiteurManager = new visiteurManager($dbh);

$contributeurArray = $contributeurManager->selectAll();
$visiteurAll = $visiteurManager->selectAll();
$visiteurArray = array();
foreach ($contributeurArray as $contr) {
    $bool = true;
    $res = -1;
    foreach ($visiteurAll as $visit) {
        $res++;
        if ($contr[2] == $visit[1]) {
            $bool = false;
        }
    }
    $bool ? array_push($visiteurArray, $visiteurAll[$res]) : '';
}

if (isset($_POST['idVis'])) {
    $visiteur = new visiteur($_POST['idVis'], '0', '0', '0', '0', '0', '0', 7);
    $result = $visiteurManager->selectId($visiteur);
    $contributeur = new contributeur($result[0][0], $_SESSION['idAdministrateur'], $result[0][1], $result[0][2], $result[0][3], $result[0][4], $result[0][5], $result[0][6], 8);
    $contributeurManager->add($contributeur);
    header("refresh:1; url=../index.php?page=alterContributor");
    exit();
}

if (isset($_POST['idCont'])) {
    $contributeur = new contributeur($_POST['idCont'], '0', '0', '0', '0', 0, '0', '0', 8);
    $result = $contributeurManager->selectId($contributeur);

    $contributeurSelected = new contributeur($result[0][0], $result[0][1], $result[0][2], $result[0][3], $result[0][4], $result[0][5], $result[0][6], $result[0][7], 8);
    $contributeurManager->removeOne($contributeurSelected);
    header("refresh:1; url=../index.php?page=alterContributor");
    exit();
}
