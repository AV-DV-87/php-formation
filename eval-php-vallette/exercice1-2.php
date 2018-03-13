<?php

// EXERCICE 1
echo "<h1>Exercice 1</h1>";

//Créer un tableau en PHP

$contact =array("prenom" => "Arnaud", "nom" => "Vallette", "adresse"=>"45 Rue Linné",
    "code_postal"=>"75005", "ville"=>"Paris", "email"=>"vallette.arnaud@gmail.com",
    "telephone"=>"0619764133", "date"=>"1987-08-29");

//vérification de la création du tableau en PHP
echo "<pre>"; print_r($contact); "</pre>";

//Affichage du tableau dans une liste HTML
echo '<ul>';

foreach ($contact as $champs => $info)
{
    echo "<li>" . $champs . " : " . $info . "</li>";
}

echo '</ul>';

echo "<hr>";







//EXERCICE 2

echo "<h1>Exercice 2</h1>";

//création de la fonction

function convert($montant,$devise)
{
    //déclaration du taux à utiliser pour la conversion
    $taux = 1.085965;
    $resultat = '';
    //calcul si devise = EUR
    switch ($devise) {

        case "EUR":
            echo "Conversion Euros -> Dollar <br>";
            $resultat = $montant * $taux;

            //affichage du résultat
            echo $resultat . "€<br>";

            //arrêt du script
            break;

        case "USD":

            echo "Conversion Dollar -> Euros<br>";
            $resultat = $montant / $taux;

            //affichage du résultat
            echo $resultat . "<br>";

            //arrêt du script
            break;
    }

}

//---test de conversion avec les deux paramètres
convert(10.895,"USD");

convert(10,"USD");

