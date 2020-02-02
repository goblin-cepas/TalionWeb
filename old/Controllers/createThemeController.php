<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include dirname(__DIR__) . '/Tools/connexionBdd.php';
include dirname(__DIR__) . '/Tables/theme.php';
include dirname(__DIR__) . '/Managers/themeManager.php';

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$themeManager = new themeManager($dbh);

if (isset($_POST['catTheme']) && isset($_POST['nomTheme'])) {

    $theme = new theme(0, $_POST['nomTheme'], $_POST['catTheme'], $_SESSION['idAdministrateur'], date("Y-m-d"), 5);

    $themeManager->add($theme);
    header("refresh:1; url=../index.php?page=createTheme");
    exit();
}

if (isset($_POST['nomTh']) && isset($_POST['catTh']) && isset($_POST['date'])) {
    $themeSelect = new theme(0, $_POST['nomTh'], $_POST['catTh'], 0, $_POST['date'], 5);
    $result = $themeManager->selectByNom($themeSelect);
    $themeARemove = new theme($result[0][0], $result[0][1], $result[0][2], $result[0][3], $result[0][4], 5);
    $themeManager->removeOne($themeARemove);
    header("refresh:1; url=../index.php?page=createTheme");
    exit();
}

$themeArray = $themeManager->selectAll();
