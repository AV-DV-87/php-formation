<?php
echo '<pre>' . print_r($_POST) . '</pre>';
if ($_POST) {

    $_POST['expediteur']  = "From: $_POST[expediteur] \n"; //pas de cote sur expediteur car déjà entre cotes
    $_POST['expediteur'] .= "MIME-Version: 1.0 \r\n"; //MIME est un protocole de standardisation pour l'envoi d'email OBLIGATOIRE
    $_POST['expediteur'] .= "Content-type: text/html; charset=utf8 \r\n"; //permet de mettre du HTML dans le corps du msg

    mail($_POST['destinataire'], $_POST['sujet'], $_POST['message'], $_POST['expediteur']); //4 arguments pour la fonction mail avec un ordre à respecter


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
        label {
            float: left;
            width: 95px;
        }

        .alert {
            background: red;
            color: yellow;
        }
    </style>
</head>
<body>

<h1>Email</h1>
<hr>
<form method="post" action="">
    <label for="destinataire">Destinataire</label>
    <input type="text" id="destinataire" name="destinataire" placeholder="destinataire">
    <br><br>
    <label for="expediteur">expediteur</label>
    <input type="text" name="expediteur" id="expediteur" placeholder="expediteur">
    <br><br>
    <label for="sujet">Sujet</label>
    <input type="text" name="sujet" id="sujet" placeholder="sujet">
    <br><br>
    <label for="message">message</label>
    <input type="text" name="message" id="message" placeholder="message">
    <br><br>
    <button type="submit">Envoi</button>
</form>
<hr>
<!--fin du formulaire 1-->

</body>
</html>
