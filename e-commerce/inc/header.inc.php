<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 27/02/2018
 * Time: 16:57
 */?>
<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

    <!--CSS PERSO et ATTENTION URL RELATIVE pour s'adapter aux pages ADMIN en sous dossier-->
    <link rel="stylesheet" href="<?= URL ?>/inc/style.css">

    <title>Boutique</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bckgnd">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= URL ?>boutique.php">AVSTORE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <?php

                if (internauteEstConnecteEtAdmin())
                {
                    echo'<li class="nav-item">
                    <a class="nav-link" href="'. URL .'admin/gestion_membre.php">Clients</a></li>';
                    echo'<li class="nav-item">
                    <a class="nav-link" href="'. URL .'admin/gestion_commande.php">Commandes</a></li>';
                    echo'<li class="nav-item">
                    <a class="nav-link" href="'. URL .'admin/gestion_boutique.php">Gestion Boutique</a></li>';

                }
                if(internauteEstConnecte())
                {
                    echo'<li class="nav-item active">
                    <a class="nav-link" href="'. URL .'profil.php">Profil</a></li>';
                    echo'<li class="nav-item active">
                    <a class="nav-link" href="'. URL .'boutique.php">La boutique</a></li>';
                    if(isset($_SESSION['panier']))
                    {
                        echo'<li class="nav-item active">
                        <a class="nav-link" href="'. URL .'panier.php">Panier <span class="badge badge-light">' . array_sum($_SESSION['panier']['quantite']) . '</span></a></li>';
                    }
                    else
                    {
                        echo'<li class="nav-item active"><a class="nav-link" href="'. URL .'panier.php">Panier</a></li>';
                    }
                    echo'<li class="nav-item active">
                    <a class="nav-link" href="'. URL .'connexion.php?action=deconnexion">Deconnexion</a></li>';

                }
                else
                {
                    echo'<li class="nav-item active">
                    <a class="nav-link" href="'. URL .'inscription.php">Inscription</a></li>';
                    echo'<li class="nav-item active">
                    <a class="nav-link" href="'. URL .'connexion.php">Connexion</a></li>';
                    echo'<li class="nav-item active">
                    <a class="nav-link" href="'. URL .'boutique.php">La Boutique</a></li>';
                    if(isset($_SESSION['panier']))
                    {
                        echo'<li class="nav-item active">
                    <a class="nav-link" href="'. URL .'panier.php">Panier <span class="badge badge-light">' . array_sum($_SESSION['panier']['quantite']) . '</span></a></li>';
                    }
                    else
                    {
                        echo'<li class="nav-item active"><a class="nav-link" href="'. URL .'panier.php">Panier</a></li>';
                    }
                }
                ?>

            </ul>
        </div>
    </div>
</nav>
<div class="container">
