<html>
<?php

include dirname(__DIR__) . '/Tools/connexionBdd.php';
include dirname(__DIR__) . '/Managers/evenementManager.php';

$eventManager3 = new evenementManager($dbh);
$eventForDisplay = $eventManager3->selectAllForDisplay();

?>
<body>
<style>
#tableEvent {
    border: 5px solid #54CBE6;
    text-align: center;
    margin-top: 10px;
}


</style>
<table border="1" id="tableEvent" align="center">
    <thead>
        <th>idEvenement</th>
        <th>Nom</th>
        <th>Date de l'évenement</th>
        <th>Effectif minimum</th>
        <th>Effectif maximum</th>
        <th>Description</th>
        <th>Inscription</th>
    </thead>
    <tbody>
        <?php
        foreach ($eventForDisplay as $element) {
            ?>

            <tr>
                <td><?php echo $element['idevent'] ?></td>
                <td><?php echo $element['nomEvent'] ?></td>
                <td><?php echo $element['dateEvent'] ?></td>
                <td><?php echo $element['effectif_min'] ?></td>
                <td><?php echo $element['effectif_max'] ?></td>
                <td><?php echo $element['description'] ?></td>
                <td><a href="index.php?page=inscrit" class="btn btn-info" role="button">S'inscrire</a></td>


            </tr>
        <?php } ?>
    </tbody>
</table>
</body>
</html>
