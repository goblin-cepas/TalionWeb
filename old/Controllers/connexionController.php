<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


include dirname(__DIR__) . '/Tools/connexionBdd.php';
include dirname(__DIR__) . '/Tables/visiteur.php';
include dirname(__DIR__) . '/Tables/contributeur.php';
include dirname(__DIR__) . '/Tables/administrateur.php';
include dirname(__DIR__) . '/Managers/visiteurManager.php';
include dirname(__DIR__) . '/Managers/administrateurManager.php';
include dirname(__DIR__) . '/Managers/contributeurManager.php';


$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$visiteurManager = new visiteurManager($dbh);
$administrateurManager = new administrateurManager($dbh);
$contributeurManager = new contributeurManager($dbh);

$error = '';

if (isset($_POST['email']) && isset($_POST['password'])) {
$_SESSION['ok'] = true;
  $visiteur = new visiteur(0, $_POST['email'], '0', '0', 0, '0', $_POST['password'], 7);
  $contributeur = new contributeur(0, $_POST['email'], '0', '0', 0, '0', '0', '0',8);
  $administrateur = new administrateur(0, '0', '0', $_POST['email']);

  $allVisiteur = $visiteurManager->selectAll();
  $allContributeur = $contributeurManager->selectAll();
  $allAdministrateur = $administrateurManager->selectAll();

  foreach ($allVisiteur as $vis) {
    
    if ($vis[1] == $visiteur->getEmail()) {
      $password = crypt(htmlentities($_POST['password']), 'dns');
      if ($password == $vis[6]) {
        $_SESSION['email'] = $vis[1];
        $_SESSION['pseudo'] = $vis[5];
        $_SESSION['nom'] = $vis[2];
        $_SESSION['prenom'] = $vis[3];
        $_SESSION['age'] = $vis[4];
        $_SESSION['idVisiteur'] = $vis[0];
        break;
      } else {
        $error = 'Password Incorrect';
        break;
      }
    }
  }

  if ($error != 'Password Incorrect') {
    foreach ($allContributeur as $contrib) {
      if ($contrib[2] == $visiteur->getEmail()) {
        $_SESSION['email'] = $contrib[2];
        $_SESSION['pseudo'] = $contrib[6];
        $_SESSION['nom'] = $contrib[3];
        $_SESSION['prenom'] = $contrib[4];
        $_SESSION['age'] = $contrib[5];
        $_SESSION['idContributeur'] = $contrib[0];
        break;
      }
    }

    foreach ($allAdministrateur as $admin) {
      if ($admin[3] == $visiteur->getEmail()) {
        $_SESSION['email'] = $admin[3];
        $_SESSION['nom'] = $admin[1];
        $_SESSION['prenom'] = $admin[2];
        $_SESSION['idAdministrateur'] = $admin[0];
        break;
      }
    }
  }
//  print_r($_SESSION);
header('Location: ../index.php?page=index');
exit();
//  header("Location: index.php");
//  header("refresh:1; url=../index.php?page=index");
} 

/*
  else {
    $error =  'Veuillez remplir tout les champs...';
    header("refresh:0.2; url =../index.php?page=connexion&error=$error");
    exit();
  }
*/






/* 
  if ($visiteurManager->selectEmail($_POST['email']) && $visiteurManager->selectPassword(crypt($_POST['password'], 'dns'), $_POST['email'])) {
    $_SESSION['Visiteur'] = true;
    $_SESSION['pseudo'] = $visiteurManager->selectPostPseudo($_POST['email']);
    $_SESSION['email'] = $_POST['email'];
    header("refresh:1; url=../index.php?page=index");
  }  else if ($administrateurManager->selectEmail($_POST['email']) && $administrateurManager->selectPassword(crypt($_POST['password'], 'dns'), $_POST['email'])) {
    $_SESSION['Administrateur'] = true;
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['id'] = $administrateurManager->selectId($_POST['email']);
    header("refresh:1; url=../index.php?page=index");
  }  else if ($contributeurManager->selectEmail($_POST['email']) && $contributeurManager->selectPassword(crypt($_POST['password'], 'dns'), $_POST['email'])) {
    $_SESSION['Contributeur'] = true;
    $_SESSION['pseudo'] = $contributeurManager->selectPostPseudo($_POST['email']);
    $_SESSION['email'] = $_POST['email'];

    header("refresh:1; url=../index.php?page=index");
  } else {
    $error = 'Ce compte n\'existe pas veuillez vous inscrire !';
  }
  if ($error != '') {
    header("refresh:0.2; url =../index.php?page=connexion&error=$error");
  }

  

  Array ( 
    [0] => Array ( [idvisit] => 1 [0] => 1 [email] => gob@gob.gob [1] => gob@gob.gob [nom] => gob [2] => gob [prenom] => gob [3] => gob [age] => 12 [4] => 12 [pseudo] => gob [5] => gob [password] => gob [6] => gob ) 
    [1] => Array ( [idvisit] => 2 [0] => 2 [email] => test@gob.gob [1] => test@gob.gob [nom] => test [2] => test [prenom] => test [3] => test [age] => 23 [4] => 23 [pseudo] => test [5] => test [password] => test [6] => test ) 
    [2] => Array ( [idvisit] => 3 [0] => 3 [email] => g@g.g [1] => g@g.g [nom] => g [2] => g [prenom] => g [3] => g [age] => 12 [4] => 12 [pseudo] => g [5] => g [password] => dnzOZUJkjDlF. [6] => dnzOZUJkjDlF. ) 
    [3] => Array ( [idvisit] => 4 [0] => 4 [email] => y@y.y [1] => y@y.y [nom] => y [2] => y [prenom] => y [3] => y [age] => 12 [4] => 12 [pseudo] => y [5] => y [password] => dn9fWby0rPC92 [6] => dn9fWby0rPC92 ) 
    [4] => Array ( [idvisit] => 5 [0] => 5 [email] => h@h.h [1] => h@h.h [nom] => h [2] => h [prenom] => h [3] => h [age] => 12 [4] => 12 [pseudo] => h [5] => h [password] => dn/DzhUSkkahs [6] => dn/DzhUSkkahs ) 
    [5] => Array ( [idvisit] => 6 [0] => 6 [email] => test@testtest.test [1] => test@testtest.test [nom] => test [2] => test [prenom] => test [3] => test [age] => 23 [4] => 23 [pseudo] => testtest [5] => testtest [password] => dnLi2sYyfN9Uw [6] => dnLi2sYyfN9Uw ) 
    [6] => Array ( [idvisit] => 7 [0] => 7 [email] => plo@plo.plo [1] => plo@plo.plo [nom] => plop [2] => plop [prenom] => plop [3] => plop [age] => 23 [4] => 23 [pseudo] => plop [5] => plop [password] => dnvBZqmfRApVM [6] => dnvBZqmfRApVM ) 
    ) 

    */
