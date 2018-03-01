<?php

//-------------CONNEXION BDD
$pdo = new PDO('mysql:host=localhost;dbname=boutique','root','',
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//-------------ouverture session
session_start();

//-------------CHEMIN qui permet de façon fixe le chemin du site sert notamment au upload de photos
define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . "/php-formation/e-commerce/");
//    echo RACINE_SITE;
//    echo"<pre>"; print_r($_SERVER);echo"<pre>";
define("URL", 'http://localhost/php-formation/e-commerce/');
//jour de mise en ligne on changera juste cette constante pour modifier tous les urls du site

$content = '';

require_once ('fonction.inc.php');