<?php

//création d'un nouvel objet de type PDO pour la BDD entrprise
$pdo = new PDO('mysql:host=localhost;dbname=entreprise','root','',
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

if($_POST) //si soumission du formulaire
{
    $resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES ('$_POST[prenom]', '$_POST[nom]', '$_POST[choixsexe]', '$_POST[choixservice]', '$_POST[date]', '$_POST[salaire]'  )");
    echo "<div class='alert alert-success'>Ajout réussi</div>";
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

    <title>Saisie employes</title>
</head>
<body>
<div class="container-fluid">
    <form method="post">
        <div class="form-group">
            <label for="prenom">Prenom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prenom" value="prenom">
        </div>
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="nom" value="nom">
        </div>
        <div class="form-group">
            <label for="service">Sexe</label>
            <select class="form-control" id="choixsexe" name="choixsexe">
                <option value="m">Homme</option>
                <option value="f">Femme</option>
            </select>
        </div>
        <div class="form-group">
            <label for="service">Service</label>
            <select class="form-control" id="choixservice" name="choixservice">
                <option value="direction">Direction</option>
                <option value="commercial">Commercial</option>
                <option value="secretariat">Secretariat</option>
                <option value="communication">Communication</option>
                <option value="informatique">Informatique</option>
                <option value="juridique">Juridique</option>
                <option value="production">Production</option>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Date d'embauche</label>
            <input type="date" class="form-control" id="date" name="date" placeholder="date d'embauche" value="date">
        </div>
        <div class="form-group">
            <label for="salaire">Salaire</label>
            <input type="number" class="form-control" id="salaire" name="salaire" placeholder="salaire" value="salaire">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary mb-2">Soumettre</button>
        </div>
    </form>
</div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
