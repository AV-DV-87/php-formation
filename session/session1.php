<h1>LES SESSIONS</h1>
<?php
session_start(); //créer un fichier session ou l'ouvre si il existe déjà
$_SESSION['pseudo'] = 'ArnaudV';
$_SESSION['prenom'] = 'Arnaud';
$_SESSION['nom'] = 'Vallette'; //en commentaire pour test de suppression
echo '<pre>'; print_r($_SESSION); '</pre>';
//la SESSION est de type array donc on peut l'affciher avec un print_r
// ces informations sont souvent utilisé pour personnalisé l'expèrience utilisateur

unset($_SESSION['nom']);
unset($_SESSION['prenomnom']); //supprimer une entrée du tableau
//session_destroy(); destruction de la session
?>
