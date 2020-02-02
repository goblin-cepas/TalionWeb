<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="Controllers/createThemeController.php">
                <div class="form-group">
                    <label for="nomTheme">Nom Theme</label>
                    <input type="text" name="nomTheme" class="form-control" id="nomTheme" aria-describedby="Nom Theme" placeholder="Nom Theme">
                </div>
                <div class="form-group">
                    <label for="catTheme">Catégorie</label>
                    <input type="text" name="catTheme" class="form-control" id="catTheme">
                </div>
                <button type="submit" class="btn btn-primary">Ajouter Theme</button>
            </form>
        </div>
    </div>
</div>
<p></p>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <?php
                foreach ($themeArray as $th) {
                    echo '<div class="col-md-4">
<div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
    <div class="card-header">Nom : ' . $th[1] . '</div>
    <div class="card-body">
        <h5 class="card-title">Catégorie : ' . $th[2] . '</h5>
        <div>crée le : ' . $th[4] . '</div>
        <form method="post" action="Controllers/createThemeController.php">
            <input type="hidden" id="nomTh" name="nomTh" value="' . $th[1] . '">
            <input type="hidden" id="catTh" name="catTh" value="' . $th[2] . '">
            <input type="hidden" id="date" name="date" value="' . $th[4] . '">
            <button type="submit" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </form>
    </div>
</div>
</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>