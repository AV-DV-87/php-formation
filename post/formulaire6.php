<?php
/*
 * Améliorer le formulaire de contact pour être le seul destinataire du message
 * Ajouter les champs société, nom, prénom. sans retirer les champs actuels
 * Ajouter au corps du message: Nom prenom société message
 */
echo '<pre>' . print_r($_POST) . '</pre>';

$_POST['expediteur']  = "From: $_POST[expediteur] \n"; //pas de cote sur expediteur car déjà entre cotes
$_POST['expediteur'] .= "MIME-Version: 1.0 \r\n"; //MIME est un protocole de standardisation pour l'envoi d'email OBLIGATOIRE
$_POST['expediteur'] .= "Content-type: text/html; charset=utf8 \r\n"; //permet de mettre du HTML dans le corps du msg

$message  = "Expediteur : $_POST[nom] $_POST[prenom] <br> Société : $_POST[societe] <br> Message : <br> $_POST[message]";
$message .= "MIME-Version: 1.0 \r\n";
$message .= "Content-type: text/html; charset=utf8 \r\n";

mail('vallette.arnaud@gmail.com', $_POST['sujet'], $message, $_POST['expediteur']);
echo $message;
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
    <label for="expediteur">expediteur</label>
    <input type="text" name="expediteur" id="expediteur" placeholder="expediteur">
    <br><br>
    <label for="nom">nom</label>
    <input type="text" name="nom" id="nom" placeholder="nom">
    <br><br>
    <label for="prenom">prenom</label>
    <input type="text" name="prenom" id="prenom" placeholder="prenom">
    <br><br>
    <label for="societe">societe</label>
    <input type="text" name="societe" id="societe" placeholder="societe">
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
