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
<a href="?fruit=cerises&poids=1000">Cerises</a><br>
<a href="?fruit=bananes&poids=1000">Bananes</a><br>
<a href="?fruit=pommes&poids=1000">Pommes</a><br>
<a href="?fruit=peches&poids=1000">Pêches</a><br>

<?php
if (isset($_GET['fruit'])) {
    include('fonction.inc.php');
    echo '<pre>'; print_r($_GET); echo '<pre>';
    echo calcul($_GET['fruit'], $_GET['poids']);
}
?>
</body>
</html>
