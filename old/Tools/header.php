<!DOCTYPE html>
<html lang="fr">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<head>
    <meta charset="UTF-8">
    <title>Event</title>
    <link rel="icon" href="favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
    body {
  background-image: url("fond.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  
}
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="index.php?page=index">Event</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Évènements
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?page=event">Liste des évenements</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php?page=map">Carte des évenements</a>
                    </div>
                </li>

                <?php
                echo (isset($_SESSION['idVisiteur']) ? ' <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Évènements de ' . $_SESSION['pseudo'] . '
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?page=event">noter mes évènements</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?page=index">mes évènements à venir</a>
                </div>
            </li>' : '');
                ?>


                <?php echo (isset($_SESSION['idContributeur']) ? '<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Contributeur ' . $_SESSION['pseudo'] . '
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?page=createEvent">Créer</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php?page=event">Liste des évènements</a>
                    </div>
                </li>' : ''); ?>


            </ul>

            <?php echo (isset($_SESSION['idAdministrateur']) ? '<li class="navbar-nav dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Administration
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?page=createTheme">Gérer thèmes</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?page=alterContributor">Gérer contributeurs</a>
                </div>
            </li>' : ''); ?>

            <?php echo (isset($_SESSION['idVisiteur']) ? '<li class="navbar-nav dropdown">
                 <li class="navbar-nav">
                 <a class="nav-link" href="index.php?page=deconnexion">Déconnexion</a>
               </li>' : '<li class="navbar-nav dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Connexion
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?page=connexion">Connexion</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?page=createUser">Inscription</a>
                </div>
            </li>'); ?>


        </div>
    </nav>

    <!-- 
        $_SESSION['Contributeur'] = true
        $_SESSION['Administrateur'] = true
        $_SESSION['Visiteur'] = true
 echo (isset($_SESSION['Administrateur']) ? $_SESSION['Visiteur'] ? '' : '' : '');
    -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12  col-md-12  main">