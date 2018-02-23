<?php
function calcul($fruit, $poids)
{
    switch($fruit)
    {
        case 'cerises' :$prix_kg = 7.1; break;
        case 'bananes' :$prix_kg = 1.96; break;
        case 'pommes' :$prix_kg = 1.74; break;
        case 'peches' :$prix_kg = 3.65; break;
        default: return "fruit inexistant"; break;
    }
    $resultat = round(($poids*$prix_kg/1000),2); //prix au gramme
    return "Les $fruit coutent $resultat Euros pour $poids grammes";
}

//echo calcul('bananes', 200);