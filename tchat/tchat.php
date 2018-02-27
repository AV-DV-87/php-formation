<?php
/**
 * TP : Tchat
 * 1- modelisation et création de la base
 *      BDD tchat
 *      table : id_commentaire // int(11) pk - ai
 *      pseudo // VARCHAR(20)
 *      message // TEXT
 *      date enregistrement//DATETIME
 * 2- connexion à la BDD
 * 3- Création du formulaire HTML (pour l'ajout de message
 * 4- Contrôle et récupération des données saisies en PHP
 * 5- Requête d'enregistrement
 * 6- Affichage des messages
 *
 */

//2- connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=tchat','root','',
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//4- Contrôle et récupération des données saisies en PHP
echo '<pre>'; print_r($_POST); echo '</pre>';


foreach ($_POST as $indice =>$valeur)
{
    $_POST[$indice] = htmlspecialchars(strip_tags($valeur));
    //htmlspecialchars rend les balises html inoffensives
    //strip_tags permet de supprimer les balises html
    $_POST[$indice] = htmlentities($valeurs);
//        $_POST[$indice] = htmlspecialchars($valeur);
}
if($_POST)
{
    //pour se protéger des erreurs XSS due à l'injection de code dans les champs


    //injection de SQL ok'); DELETE FROM commentaire; ( va supprimer toutes les lignes de la table commentaire

    //affichage de la requête en front pour voir la modification
//    $req = ("INSERT INTO commentaire (pseudo, date, message ) VALUES ('$_POST[pseudo]', NOW() , '$_POST[message]' )");
//    $resultat = $pdo->exec($req);
//    echo $req;
    //injection d'un script JS infini
    //injection d'un style HTML
    $resultat =$pdo->prepare("INSERT INTO commentaire (pseudo, date, message) VALUES (:pseudo, NOW(), :message)");
    $resultat->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
    $resultat->bindValue(':message', $_POST['message'], PDO::PARAM_STR);

    $resultat->execute();



//METHODE CLASSIQUE
//    $resultat = $pdo->exec("INSERT INTO commentaire (pseudo, date, message ) VALUES ('$_POST[pseudo]', NOW() , '$_POST[message]' )");
//    echo "<div class='alert alert-success'>Ajout réussi</div>";
}

echo '<div class="col-6">';
$resultat = $pdo->query("SELECT pseudo, message, DATE_FORMAT(date, '%H:%i:%s') AS heurefr, 
DATE_FORMAT(date, '%d/%m/%Y') AS datefr FROM commentaire ORDER BY date DESC");
echo '<legend><h2>' . $resultat->rowCount() . ' commentaire(s)</h2></legend>';





while($commentaire = $resultat->fetch(PDO::FETCH_ASSOC))
{

    echo '<blockquote class="blockquote text-left mb-2 bg-success p-2 rounded">';
        echo "<p class='mb-0'>$commentaire[message]</p>";
        echo "<footer class='blockquote-footer text-white text-right'> $commentaire[pseudo] - le <cite>$commentaire[datefr]</cite> à <cite>$commentaire[heurefr]</cite></footer>";
    echo '</blockquote>';

}
echo '</div>';
?>





<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Adopte un tchat</title>
</head>
<body class="container-fluid">

<!--3- Création du formulaire HTML (pour l'ajout de message-->
<form method="post">
    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="pseudo">
    </div>
    <div class="form-group">
        <label for="message">Message</label>
        <textarea type="text" class="form-control" id="message" name="message" placeholder="votre message" rows="3"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary mb-2">Envoyer</button>
    </div>
</form>





<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>