<?php
// effectuer 4 liens html pointant sur la même page avec le nom des fruits
// envoyer cerises dans l'url si l'on clic sur le lien cerise
//tenter d'afficher cerise sur la pages web si on a cliqué dessus (si cerise dans l'url

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boutique</title>
</head>

<body>
<h1>Bienvenue dans notre boutique</h1>
<a href="liens.php?fruit=cerises&poids=1000">Cerises</a><br>
<a href="liens.php?">Bananes</a><br>
<a href="liens.php?">Pommes</a><br>
<a href="liens.php?">Pêches</a><br>

<?php
if ($_GET) {
    include('fonction.inc.php');
    echo calcul($_GET['fruit'], $_GET['poids']);
}
?>
</body>
</html>
