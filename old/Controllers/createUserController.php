<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include dirname(__DIR__) . '/Tools/connexionBdd.php';
include dirname(__DIR__) . '/Tables/visiteur.php';
include dirname(__DIR__) . '/Managers/visiteurManager.php';

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



$error = '';

if (isset($_POST['email']) && isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['age']) && isset($_POST['pseudo']) && isset($_POST['password'])) {

  if (empty($_POST['email']) || empty($_POST['prenom']) || empty($_POST['nom']) || empty($_POST['age']) || empty($_POST['pseudo']) || empty($_POST['password'])) {
    $error =  "Veuillez remplir tout les champs...";
  }
  $visiteurManager = new visiteurManager($dbh);

  if ($visiteurManager->selectEmail($_POST['email'])) {
    $error = "Désoler ce mail existe déjà";
  } else if ($visiteurManager->selectPseudo($_POST['pseudo'])) {
    $error = "Désoler ce pseudo existe déjà";
  }
  if ($error != '') {
    header("refresh:0.2; url =../index.php?page=createUser&error=$error");
  } else {


    $email = htmlentities($_POST['email']);
    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $age = htmlentities($_POST['age']);
    $pseudo = htmlentities($_POST['pseudo']);
    $password = crypt(htmlentities($_POST['password']), 'dns');


    $visiteur = new visiteur(0, $email, $nom, $prenom, $age, $pseudo, $password, 7);
    $visiteurManager->add($visiteur);
    header("refresh:1; url=../index.php?page=index");
    exit();
  }
}
