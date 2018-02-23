<?php
if ($_POST)
{
    $erreur = "";
    if (iconv_strlen($_POST['pseudo']) < 5 || iconv_strlen($_POST['pseudo']) > 20)
    {
        $erreur.= "<p class='alert'>Votre pseudo doit comporter entre 5 et 20 caractères</p>";
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $erreur.= "<p class='alert'>Email invalide</p>";
    }
    if (!filter_var($_POST['cp'], FILTER_VALIDATE_INT) || iconv_strlen($_POST['cp']) !== 5 )
    {
        $erreur .= "<p class='alert'>Code Postal invalide</p>";
    }
    if(!preg_match('#^[a-zA-Z0-9.-_]+$#',$_POST['prenom']))
    {
       $erreur .= "<p class='alert'>Prenom invalide : </p>";
    }
    if (empty($erreur))
    {
        foreach ($_POST as $indice => $valeur) {
            echo $indice . ' : ' . $valeur . "<br>";
        }
        echo "<p>Bienvenur parmis nous";

    }
    echo $erreur;



}
?>




<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire 2</title>
    <style>
        label{
            float: left;
            width: 95px;
        }
        .alert
        {
            background: red;
            color: yellow;
        }
    </style>
</head>
<body>

<h1>Formulaire Inscription</h1>
<hr>
<form method="post" action="">
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo" placeholder="pseudo">

    <br><br>
    <label for="mdp">Mot de passe</label>
    <input type="text" name="mdp" id="mdp" placeholder="Mot de passe">
    <br><br>
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" placeholder="Nom">
    <br><br>
    <label for="prenom">Prenom</label>
    <input type="text" name="prenom" id="prenom" pattern="[a-zA-Z0-9.-_]" title="caractères acceptés : a-zA-Z0-9.-_" placeholder="Prenom">
    <br><br>
    <label for="email">Email</label>
    <input type="text" name="email" id="email" placeholder="Email">
    <br><br>
    <label for="adresse">Adresse</label>
    <input type="text" name="adresse" id="adresse" placeholder="Adresse">
    <br><br>
    <label for="cp">Code Postal</label>
    <input type="text" name="cp" id="cp" placeholder="Code Postal">
    <br><br>
    <button type="submit">Inscription</button>
</form>
<hr>
<!--fin du formulaire 1-->

</body>
</html>