<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="./Controllers/createUserController.php">
                <?php
                if (!empty($_GET['error'])) {
                    $error = '<div style="color:red;">' . $_GET['error'] . "</div>";
                }

                ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                    <small id="emailHelp" class="form-text text-muted">Nous ne le partagerons à personne !</small>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Prénom</label>
                    <input type="text" name="prenom" class="form-control" id="formGroupExampleInput" placeholder="Prénom">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Nom</label>
                    <input type="text" name="nom" class="form-control" id="formGroupExampleInput" placeholder="Nom">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Pseudo</label>
                    <input type="text" name="pseudo" class="form-control" id="formGroupExampleInput" placeholder="Pseudo">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Age</label>
                    <input type="text" name="age" class="form-control" id="formGroupExampleInput" placeholder="Age">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="formGroupExampleInput">
                </div>
                <button type="submit" class="btn btn-primary">S'inscrire</button>
                <?php echo $error; ?>
            </form>
        </div>
    </div>
</div>