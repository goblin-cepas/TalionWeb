<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="Controllers/inscritController.php">
                <?php
                if (!empty($_GET['error'])) {
                    $error = '<div style="color:red;">' . $_GET['error'] . "</div>";
                }
                ?>
                <div class="form-group ">
                    <label for="formGroupExampleInput">Id de l'évenement</label>
                    <input type="text" name="idEvent" class="form-control " placeholder="Id" required>
                </div>
                <div class="form-group ">
                    <label for="exampleInputEmail1">Votre Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                </div>
                <button type="submit" id="validbutton" class="btn btn-success">Inscription</button>
                <?php echo $error; ?>
        </div>
    </div>
</div>