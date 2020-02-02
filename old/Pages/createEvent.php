<?php
include dirname(__DIR__) . '/Tools/connexionBdd.php';
?>


<?php
if (!empty($_GET['error'])) {
    $error = '<div style="color:red;">' . $_GET['error'] . "</div>";
}
?>
<html>
<style type="text/css">
    #map {
        height: 400px;
        width: 900px;
        float: right;
    }

    #validbutton {
        position: relative;
    }
</style>

<form method="post" action="./Controllers/createEventController.php">
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="formGroupExampleInput">Nom de l'évenement</label>
            <input type="text" name="nomEvent" class="form-control " placeholder="Nom" required>
        </div>
        <div class="form-group col-md-2">
            <label for="formGroupExampleInput">Ville</label>
            <input type="text" name="VilleEvent" class="form-control " id="ville" placeholder="Ville" required>
        </div>
        <div class="form-group col-md-6">
            <label for="formGroupExampleInput">Date</label>
            <input type="date" name="Date" class="form-control " placeholder="Date">
        </div>
        <div class="col-md-4">
            <label for="formGroupExampleInput">Rue</label>
            <input type="text" name="Rue" class="form-control" id="nomRue" placeholder="Rue" required>
        </div>
        <div class="col-md-4">
            <label for="formGroupExampleInput">Numéro de rue</label>
            <input type="number" name="NumRue" class="form-control" id="numRue" placeholder="Numéro" required>
        </div>
        <div class="col-md-4">
            <label for="formGroupExampleInput">Code postal</label>
            <input type="number" name="CodePostal" class="form-control" id="codePostal" placeholder="Code postal" required>
        </div>
        <div class="form-group col-md-2">
            <label for="formGroupExampleInput">Effectif minimum</label>
            <input type="number" name="effectifMin" class="form-control " placeholder="Minimum" required>
        </div>
        <div class="form-group col-md-2">
            <label for="formGroupExampleInput">Effectif maximum</label>
            <input type="number" name="effectifMax" class="form-control " placeholder="Maximum" required>
        </div>
        <div class="form-group col-md-2">
            <label for="formGroupExampleInput">Longitude</label>
            <input type="text" name="Long" class="form-control " id="inputLon" placeholder="Longitude" required>
        </div>
        <div class="form-group col-md-2">
            <label for="formGroupExampleInput">Latitude</label>
            <input type="text" name="Lat" class="form-control " id="inputLat" placeholder="Latitude" required>
        </div>
        <div class="form-group col-md-2">
            <label for="exampleFormControlSelect1">Theme</label>
            <select class="form-control" name="theme" id="exampleFormControlSelect1">
                <option>Choisissez un theme..</option>
                <?php foreach ($themeArrayEvent as $tim) { ?>
                    <option><?php echo $tim[1]; ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" name="Description" id="exampleFormControlTextarea1" rows="3" placeholder="Limite : 150 caractères"></textarea>
            <button type="submit" id="validbutton" class="btn btn-success">Créer un évenement</button>
        </div>
        <div id="map">
        </div>
    </div>
</form>


</html>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/Pages/mapSrc.js"></script>