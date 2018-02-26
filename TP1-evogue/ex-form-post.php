<?php

foreach ($_POST as $catego => $carac)
{
    echo "$catego : $carac <br>";
}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<div class="container-fluid">
    <form method="post">
        <div class="form-group">
            <label for="titre">TITRE</label>
            <input type="text" class="form-control" name="titre" id="titre" placeholder="titre">
        </div>
        <div class="form-group">
            <label for="couleur">COULEUR</label>
            <input type="text" class="form-control" name="couleur" id="couleur" placeholder="couleur">
        </div>
        <div class="form-group">
            <label for="taille">TAILLE</label>
            <input type="number" class="form-control" name="taille" id="taille" placeholder="taille">
        </div>
        <div class="form-group">
            <label for="poids">POIDS</label>
            <input type="number" class="form-control" name="poids" id="poids" placeholder="poids">
        </div>
        <div class="form-group">
            <label for="prix">PRIX</label>
            <input type="number" class="form-control" name="prix" id="prix" placeholder="prix">
        </div>
        <div class="form-group">
            <label for="description">DESCRIPTION</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="description">
        </div>
        <div class="form-group">
            <label for="stock">STOCK</label>
            <input type="text" class="form-control" name="stock" id="stock" placeholder="stock">
        </div>
        <div class="form-group">
            <label for="fournisseur">FOURNISSEUR</label>
            <input type="text" class="form-control" name="fournisseur" id="fournisseur" placeholder="couleur">
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>

    </form>
</div>




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
