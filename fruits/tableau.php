<?php
/** 1- déclarer un tableau array avec tous les fruits
 * 2- déclarer un tableau array avec les poids suivants : 100 500 1000 1500 2000
 * 3-afficher les deux tableaux
 * 4- sortir le fruits cerises et le poids 500 en passant
 * par vos tableaux pour les transmettre à la fonction calcul et obtenir le prix
 * 5 - Sortir tous les prix pour les cerises avec tous les poids (boucle)
 * 6 - Sortir les prix pour tous les fruits avec tout les poids
 * 7 - Affichage HTML de ce tableau
 */

$tabfruits = array('cerises', 'bananes', 'pommes', 'peches');
$tabpoids = array(100, 500, 1000,1500,2000);

echo print_r($tabfruits) . '<br>';
echo print_r($tabpoids) . '<br>';

//  4- sortir le fruits cerises et le poids 500 en passant
include ('fonction.inc.php');

echo calcul($tabfruits[0], $tabpoids[1]) . '<br>';

//* 6 - Sortir les prix pour tous les fruits avec tout les poids
// * 7 - Affichage HTML de ce tableau
echo '<table><tr>';
echo '<th>FRUITS</th>';
foreach($tabfruits as $indice => $fruit)
{

    echo "<tr>";
    echo '<th>' . $fruit . '</th>';
    foreach ($tabpoids as $indice2 => $poids){
        echo '<tr>';
        echo "<th> $poids g </th>";
        echo "<td>" .calcul($fruit, $poids) . "</td>";

    }

}
echo "</tr>";
echo'</table>'

?>


