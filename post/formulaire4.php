<?php

echo "<pre>"; print_r($_POST); echo "</pre>";
if($_POST)

{
    //http://php.net/manual/fr/function.fopen.php
    //http://php.net/manual/fr/function.fwrite.php
    $list = fopen("liste.txt", "a");
    $contact = "\r\n" . $_POST['pseudo'] . " - " . $_POST['email'] ;
    fwrite($list, $contact);
}


    // écriture dans un fichier de façon dynamique :
// les fonctions prédéfinies suivantes : fopen(), fwrite(), fclose()