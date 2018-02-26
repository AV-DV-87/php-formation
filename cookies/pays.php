<?php
/**
 * Fichier stocké coté client et qui garde des préférences ou des produits consultés
 */
//
if(isset($_GET['pays'])) //si un pays est passé dans l'url
{
    $pays = $_GET['pays'];
}
//cas ou un pays est choisi
elseif (isset($_COOKIE['pays'])) //si on cookie existe et que pas de if on récupère la valeur du cookie existant
{
    $pays = $_COOKIE['pays'];
}
//cas de première visite la langue par défaut sera fr
else
{
    $pays = 'fr;';
}
echo time();
//temps de conservation du cookie de 1 ans défini à part
$un_an = 365*24*3600; // cookie en seconde par an
setcookie("pays", $pays, time()+$un_an);
//ces cookies ne doivent pas contenir des informaitions sensibles car elles sont stockés
//sur l'ordi de l'utilisateur en clair
switch ($pays)
{
    case 'fr':
    echo 'Bonjour vous êtes sur un site en français';
    break;

    case 'es':
    echo 'Bonjour vous êtes sur un site en espagnol';
    break;

    case 'an':
    echo 'Bonjour vous êtes sur un site en anglais';
    break;

    case 'it':
    echo 'Bonjour vous êtes sur un site en italien';
    break;
}
?>
<h1>Votre langue :</h1>
<ul>
    <li><a href="?pays=fr">France</a></li>
    <li><a href="?pays=es">Espagne</a></li>
    <li><a href="?pays=an">Angleterre</a></li>
    <li><a href="?pays=it">Italie</a></li>

</ul>