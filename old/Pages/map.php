
<?php
include dirname(__DIR__) . '/Managers/evenementManager.php';
include dirname(__DIR__) . '/Tools/connexionBdd.php';
include dirname(__DIR__) . '/Tables/theme.php';
include dirname(__DIR__) . '/Tables/lieu.php';
include dirname(__DIR__) . '/Tables/evenement.php';
include dirname(__DIR__) . '/Managers/themeManager.php';
include dirname(__DIR__) . '/Managers/lieuManager.php';


$eventManager2 = new evenementManager($dbh);
$eventArray = $eventManager2->selectAll();
?>


<script>
 var evenement = <?php  echo json_encode($eventArray); ?>;
</script>
<?php if(isset($_SESSION['idContributeur'])) {?>
<a href="index.php?page=createEvent" class="btn btn-info" role="button">Créer un évenement</a>
<?php } ?>
<?php include 'MapScript.html'; ?>

