<?php 
include dirname(__DIR__) . '/Tools/connexionBdd.php';
include dirname(__DIR__) . '/Tables/inscrit.php';
include dirname(__DIR__) . '/Managers/inscritManager.php';
include dirname(__DIR__) . '/Managers/visiteurManager.php';

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$error = '';

if(isset($_POST['idEvent']) && isset($_POST['email'])) {
    $visiteurMan = new visiteurManager($dbh);
    $inscritMan = new inscritManager($dbh);

    if(!($visiteurMan->selectEmail($_POST['email']))) {
        $error = "Désoler aucun compte ne correspond à ce mail";
    }
    if ($error != '') {
        header("refresh:0.2; url =../index.php?page=inscrit&error=$error");
      }
      else {
          $idvisit = $visiteurMan->selectIdByEmail($_POST['email']);
          $inscription = new inscrit($_POST['idEvent'],$idvisit,date("Y-m-d"),2);
          $inscritMan->add($inscription);

          header("refresh:1;  url=../index.php?page=event");

      }

}






?>