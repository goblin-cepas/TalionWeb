<p></p>
<h4 class="text-center">Visiteurs</h4>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <?php
                foreach ($visiteurArray as $vis) {
                    echo '<div class="alert alert-secondary col-12" role="alert">
    <button type="button" class="btn btn-secondary col-2">' . $vis[5] . '</button>
    <button type="button" class="btn btn-secondary col-2">' . $vis[2] . '</button>
    <button type="button" class="btn btn-secondary col-2">' . $vis[3] . '</button>
    <button type="button" class="btn btn-secondary col-2">' . $vis[4] . '</button>
    <button type="button" class="btn btn-secondary col-3">' . $vis[1] . '</button>
    <p></p>
    <form method="post" action="Controllers/alterContributorController.php">
        <input type="hidden" id="idVis" name="idVis" value="' . $vis[0] . '">
        <button type="submit" class="btn btn-success col-12">Passer Contributeur</button>
    </form>
</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>



<h4 class="text-center">Contributeurs</h4>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <?php foreach ($contributeurArray as $cont) {
                    echo '<div class="alert alert-secondary col-12" role="alert">
                        <button type="button" class="btn btn-secondary col-2">' . $cont[6] . '</button>
                    <button type="button" class="btn btn-secondary col-2">' . $cont[3] . '</button>
                    <button type="button" class="btn btn-secondary col-2">' . $cont[4] . '</button>
                    <button type="button" class="btn btn-secondary col-2">' . $cont[5] . '</button>
                    <p></p>
                    <form method="post" action="Controllers/alterContributorController.php">
                        <input type="hidden" id="idCont" name="idCont" value="' . $cont[0] . '">
                        <button type="submit" class="btn btn-danger col-12">Supprimer</button>
                    </form>
                    </div>';
                } ?>

            </div>
        </div>
    </div>
</div>