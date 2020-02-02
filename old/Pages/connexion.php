<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="./Controllers/connexionController.php">
                <?php if (!empty($_GET['error'])) {
                    $error = '<div style="color:red;">' . $_GET['error'] . "</div>";
                }
                ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="formGroupExampleInput">
                </div>
                <button type="submit" class="btn btn-primary">Connexion</button>
                <?php echo $error; ?>
            </form>
        </div>
    </div>
</div>