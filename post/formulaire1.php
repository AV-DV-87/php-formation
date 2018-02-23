<?php
/*
 * les Superglobales PHP : ce sont des variables de types array prédéfinies dans le code
 * et qui permette de véhiculer certaines informations. On peut les appeler partout dans le code
 * aussi dans l'espace global que local
 */
//echo '<pre>';print_r($_SERVER); echo'</pre>'; //affiche les infos du server
echo '<pre>';print_r($_POST); echo'</pre>';
//exercice : afficher les données saisies dans le formulaire
if ($_POST) {
    echo "<p>Bienvenue </p>" . $_POST['pseudo'] . $_POST['mdp'];
}
echo '<hr>';

//exercice : afficher les données saisies dans le formulaire avec une boucle
foreach ($_POST as $connexion => $infoconnexion)
{
    echo $connexion . ':' . $infoconnexion . '<br>';
}



?>




<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire 1</title>
    <style>
        label{
            float: left;
            width: 95px;
        }
    </style>
</head>
<body>

<h1>Formulaire 1</h1>
<hr>
<form method="post" action="">
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo" placeholder="pseudo">
    <br><br>
    <label for="mdp">Mot de passe</label>
    <input type="text" name="mdp" id="mdp" placeholder="Mot de passe">
    <br><br>
    <button type="submit">Connexion</button>
</form>
<hr>
<!--fin du formulaire 1-->

</body>
</html>




