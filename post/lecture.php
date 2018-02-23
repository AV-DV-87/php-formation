<?php
//afficher les données récupérées dans liste.txt sous forme de array avec file()
$nom_fichier = 'liste.txt';
$fichier = file($nom_fichier);
echo '<pre>'; print_r($fichier); echo'</pre>';



//exercice affichage données du array de $fichier à l'aide d'une boucle

foreach ($fichier as $index => $contact)
{
    echo $contact . '<br>';
}