<style>
    h2 {
        margin: 0;
        font-size: 15px;
        background: #dedede;
        text-align:: center;
        padding: 10px;
    }
</style>
<h2>Ecriture et affichage</h2>
<!-- possibilité d'écrire du HTML dans un fichier PHP mais l'inverse n'est pas possible-->

<?php

echo 'bonjour'; // echo est une instruction d'affichage
echo '<h3>bonjour</h3>';

echo '<hr><h2>Commentaires</h2></hr>';
print 'texte texte texte'; //seconde méthode pour afficher directement sur la page


echo '<hr><h2>Variables : types, declaration, affectation</h2></hr>';
/*espace nommé qui permet de conserver une valeur
ne commence jamais par un chiffre, ne contient pas d'accent
sensible à la case $variable != $Variable
*/
$a = 127;
echo gettype($a);

echo '<br>';

$b = 1.5;
echo gettype($b); // de type double

echo '<br>';

$c = "chaine de caractère";
echo gettype($c); // de type string

echo '<br>';

$d = "127";
echo gettype($d); //pass en type string avec les cotes

$e = true;
echo gettype($e); // un boolean

//------------------CONCATENATION-----------------
echo '<h2>concatenation</h2>';
$x = "bonjour";
$y = " tout le monde";
echo $x . $y . "<br>";

echo "$x $y <br>"; //les variables sont évaluées en double cote mais pas en simple
echo 'aujourd\'hui <br>'; //caractère échappement slash inversé
echo "Hey !" . $x . $y . "<br>"; //ces points concatenation peuvent être remplacé par des ","

//------------------CONCATENATION lors de l'affectation-----------------
echo '<h2>CONCATENATION lors de l\'affectation</h2>';
$prenom1 = "Gregory";
$prenom1 = "Andreï";
echo $prenom1 . '<br>'; // remplace gregory par andreï

$prenom2 = "Gregory";
$prenom2 .= "Andreï"; // concatenation de la valeur de prenom1 et prenom 2
echo $prenom2 . '<br>';

//------------------Constante et constante magique-----------------
echo '<h2>Constante et constante magique</h2>';
//variable dont la valeur ne peut être réattribuées par l'execution du script
define('UNECONSTANTE', 'Paris');
echo UNECONSTANTE . '<br>';
// UNECONSTANTE ne pourra pas être redéfinie
echo __FILE__;
echo __LINE__ . '<br>';

//------------------Exercice Variable-----------------
echo '<h2>Exercice Variable</h2>';
//afficher bleu blanc rouge avec les tirets en mettant chaque couleur dans une variable
$bleu = 'bleu';
$blanc = 'blanc';
$rouge = 'rouge';

echo $bleu . "-" . $blanc . "-" . $rouge . '<br>';

//------------------Opérateurs arithmétiques-----------------
echo '<h2>Opérateurs arithmétique</h2>';
$a = 10;
$b = 2;
echo $a + $b . '<br>';
echo $a - $b . '<br>';
echo $a / $b . '<br>';
echo $a * $b . '<br>';

//------------------Opération / Affectation-----------------
echo '<h2>Opération / Affectation</h2>';
$a += $b; //équivaut à $a = $a + $b
echo $a;
//de même pour les autres opérateurs
$a -= $b;
echo $a;
$a *= $b;
echo $a;
$a /= $b;
echo $a . '<br>';

//------------------Structure conditionnelle-----------------
echo '<h2>Structure conditionnelle</h2>';


//isset et empty
$var1 = 0;
$var2 = 1;
if (empty($var1)) {
    echo '0, vide ou non définie' . '<br>';
    //fonctionne aussi avec une variable qui n'a pas encore été définie
}

if (isset($var2)) {
    echo('var2 existe et est définie par rien');
}
//possibilité de combiné les conditions
if (isset($var2) && !empty($var2)) {
    echo('var2 existe et n\'est pas vide');
}

//------------------Opérateur de comparaison-----------------
echo '<h2>opérateurs de comparaison</h2>';
//même que sur Javascript
//exemple
$a = 10;
$b = 5;
$c = 2;
if ($a > $b) {
    echo 'A est bien supérieur à B';
} else {
    echo "Non c'est B qui est supérieur à A";
}
echo '<br>';
if ($a > $b && $b > $c) {
    echo "Ok pour les deux conditions";
}
echo '<br>';
if ($a == 9 || $b > $c) {
    echo "ok pour au moins l'une des 2 conditions";
} else {
    echo "Nous sommes dans le else";
}
echo '<br>';
//ELSEIF
if ($a == 8) {
    echo '1 - a est égal à 8';
} elseif ($a != 10) {
    echo '2 - a est différent de 10';
} else {
    echo "3- tout le monde a faux";
}
//prend les conditions dans l'ordre et s'arrète des la première condition remplie et stop le script

//------------------Conditions exclusives-----------------
echo '<h2>Conditions exclusives</h2>';
if ($a == 10 XOR $b == 6) {
    echo "ok conditions exclusive <br>";
    //XOR seulement si une des deux conditions est bonnes et pas si les deux sont bonnes
    //ou mauvaise
}
//forme contractée de IF
echo ($a == 10) ? "A est égal à 10" : "A n'est pas égal à 10";
// : est le else et () ? le IF
$vara = 1;
$varb = "1";
if ($vara == $varb) {
    echo "il s'agit de la même chose<br>";
}
//comparaison valeur et type
if ($vara === $varb) {
    echo "il s'agit de la même chose<br>";
} else {
    echo 'valeur ok mais pas le type<br>';
}

//------------------Conditions switch-----------------
echo '<h2>Conditions switch</h2>';
$couleur = 'jaune';
//valable pour un grands nombres de cas
switch ($couleur) {
    case 'bleu':
        echo "vous aimez le bleu";
        break; //si vérifié stop le script

    case 'rouge':
        echo "vous aimez le rouge";
        break;

    default: //si jamais aucun des autres cas ne se réalise
        echo "vous aimez rien <br>";
        break;
}
// exercice d'application
//la même chose mais en if ifelse
if ($couleur == 'bleu') {
    echo "vous aimez le bleu";
} elseif ($couleur == 'rouge') {
    echo "vous aimez le rouge";
} else {
    echo "vous aimez rien";
}

//------------------FONCTIONS PREDEFINIES-----------------
echo '<h2>Fonctions prédéfinies</h2>';

echo "Date: ";
echo date("d/m/Y <br>");

$email = "vallette.arnaud@gmail.com";
echo strpos($email, "a");
//retourne la position du caractère spécifique dans une chaîne
//Argument 1--chaîne de caractère dans laquelle rechercher
//Argument 2--caractère à rechercher
$email2 = "bonjour";
echo strpos($email2, "@") . '<br>'; //n'affiche rien mais renvoi false
var_dump(strpos($email2, "@")); //comme un consol.log renvoi un boolean si c'est faux = false

$phrase = "une phrase bien longue bien longue";
echo iconv_strlen($phrase) . '<br>'; //renvoi la longueur d'une chaine de caractère utile pour faire un contrôle

$texte = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean pharetra posuere luctus. Donec luctus condimentum nunc at convallis. Suspendisse accumsan sodales orci, non tempor nisi aliquam eu. Donec non elit euismod, volutpat ligula porttitor, dapibus mauris. In sit amet lobortis massa. Aenean eget consequat nulla. ";
echo substr($texte, 0, 30) . ' <a href="">...lire la suite</a>';
//renvoi une partie de la chaine avec index de caractère de debut et de fin

//------------------FONCTIONS PREDEFINIES-----------------
echo '<h2>Fonctions utilisateurs ok</h2>';

function separation() //déclaration d'une fonction sans argument
{
    echo "<hr><hr><hr>";
}

//execution
separation();

function bonjour($qui) //fonction avec variable de réception
{
    echo "Bonjour $qui <br>";
}

bonjour('andreï');

//------------------ESPACE LOCAL ET GLOBAL-----------------
echo '<h2>ESPACE LOCAL ET GLOBAL</h2>';

function joursemaine()
{
    $jour = "jeudi";
    return $jour; //sort de la fonction dès que return est utilisé
    echo 'ALLO'; //n'apparait pas car après return
}

echo joursemaine();
//echo $jour; //ne fonctionne pas car la variable jour est déclaré en local dans la fonction joursemaine
echo '<br>';
$pays = 'france';
function affichagePays()
{
//    echo $pays; //ne fonctionnera pas car elle est en global donc
    global $pays; //ce mot clé permettre d'inclure une variable globale
    echo $pays;
}

affichagePays();
echo '<br>';
function appliqueTva($nombre)
{
    return $nombre * 1.2;
}

echo appliqueTva(50);
echo '<br>';
//exercice améliorer la fonction pour choisir le taux appliqué
function appliqueTaxe($nombre, $taux = 20)
{
    return $nombre * (1 + ($taux / 100));
}

echo appliqueTaxe(500, 10);
echo '<br>';
echo appliqueTaxe(500, 20);

meteo('été', '28'); //une fonction peut être appelé avant d'être déclarée
function meteo($saison, $temperature)
{
    echo "Nous sommes en $saison et il fait $temperature degre(s) <br>";
}
meteo('hiver', '5');

function meteo2($saison, $temperature)
{
    if ($temperature == 1 || $temperature == 0 || $temperature == -1)
    {
        echo "Nous sommes en $saison et il fait $temperature degre <br>";
    }
    else
    {
        echo "Nous sommes en $saison et il fait $temperature degres <br>";
    }
}

meteo2('été', 30);
meteo2('hiver', -1);

//------------------BOUCLES-----------------
echo '<h2>BOUCLES</h2>';

$i = 0;
while($i < 3) //while "tant que"
{

    if ($i == 2)
    {
        echo "$i";
    }
    else
    {
        echo "$i---";

    }
    $i++;
    echo'<br>';
}

//boucle FOR
for($j = 0; $j < 16; $j++)
{
    echo $j;
}

//exercice : afficher 30 option via une boucle
echo '<select>';
    for($i = 0; $i < 31; $i++)
    {
        echo "<option>$i</option>";

    }

echo'</select>';

//boucle 0-9 sur une ligne dans un tableau
echo '<table border="1"><tr>';
    for ($i = 0; $i < 10; $i++)
    {
        echo "<td>$i</td>"; //attention si simple cote les variables ne sont pas traduites
    }
echo'</tr></table>';

    // tableau de 0-99 sur 10 lignes

$z = 0;
echo '<table border="1">';
for ($ligne = 0; $ligne < 10; $ligne++)
{
    echo'<tr>';
    for ($cellule = 0; $cellule < 10; $cellule ++)
    {
        echo '<td>' . $z . '</td>';
        $z++;
    }
}
echo'</table>';
echo $z;

//------------------Boucle et tableau de données-----------------
echo '<h2>BOUCLE et Tableau de données</h2>';
//peut contenir plusieurs variables
$liste = array("Grégory", "John", "Andrei", "Adeline");
echo $liste; //ne peut être affiché directement comme une variable

echo '<pre>';var_dump($liste); echo '</pre>';
//Voici l'affichage avec un preformattage et un var_dump
//array(4) {
//    [0]=>
//  string(8) "Grégory"
//    [1]=>
//  string(4) "John"
//    [2]=>
//  string(6) "Andrei"
//    [3]=>
//  string(7) "Adeline"
//}
echo '<pre>';print_r($liste); echo '</pre>';
//Array
//(
//    [0] => Grégory
//    [1] => John
//[2] => Andrei
//[3] => Adeline
//)

//Boucles spécialement prévue pour les arrays
$tab[] ="France";
$tab[] ="Italie";
$tab[] ="Angleterre";
$tab[] ="Portugal";
$tab[] ="France"; //moyen de créer et d'ajouter un tableau directement

echo '<pre>';print_r($tab); echo '</pre>';

//Exercice
echo $tab[1] . "<hr>";

//BOUCLE FOR EACH : parcours un tableau jusqu'à ce qu'il n'y ait plus
//de ligne à parcourir, itération automatique sur les index

foreach($tab as $info)
{
echo $info . "<br>";
}

//si on voulait afficher l'indice

foreach($tab as $indice => $info) //une variable indice qui parcours les index
    //une variable info qui parcourt les valeurs
{
    echo $indice . '=>' . $info . '<br>';
}

$couleur =array("j" => "jaune", "r" => "rouge", "v" => "vert", "b" => "bleu");

echo '<pre>';print_r($couleur); echo '</pre>';

//Exercice affichage

foreach($couleur as $indice => $info) //une variable indice qui parcours les index
    //une variable info qui parcourt les valeurs
{
    echo $indice . '=>' . $info . '<br>';
}

//longueur d'un tableau
echo 'Taille du tableau : ' . count($couleur) . "<br>";
echo 'Taille du tableau : ' . sizeof($couleur) . "<br>";
//extraire toutes les données en une chaîne
echo implode("-",$couleur);
print_r(array_values($couleur));

//------------------Tableau multidimensionnel-----------------
echo '<h2>BOUCLE et Tableau de données</h2>';

$tab_multi = array(
        0 => array("prenom" => "Gregory", "nom" => "Lacroix"),
        1 => array("prenom" => "Adeline", "nom" => "Clere"),
);
echo '<pre>';print_r($tab_multi); echo '</pre>';

echo $tab_multi[1]["prenom"] . '<br>';

//extraire les valeurs à l'aide de boucles
foreach($tab_multi as $indice1 => $tableau)
{
    echo '<hr>';
    foreach ($tableau as $indice2 => $valeurs)
        {
           echo $valeurs;
        }

}

?>
<!---->

<?= "<br>raccourci pour echo" // on peut fermer la balise php repartir sur html et revenir sur une balise php        ?>









