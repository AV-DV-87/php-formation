<?php
//des class prédéfinies existe en PHP pour faire certains traitement spécifique
//notamment les class PDO
echo '<h2> 01. PDO : Connexion BDD </h2>';
$pdo = new PDO('mysql:host=localhost;dbname=entreprise','root','',
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
// les options peuvent etre trouvées dans la doc
// PDO:: car PDO est déjà instancié par défaut
echo '<pre>'; var_dump($pdo); echo '<pre>';

echo '<p> Les méthodes issues de la class PDO : </p>'; //get class method renvoi un array
echo '<pre>'; print_r(get_class_methods($pdo)); echo '<pre>';

echo '<h2> 02 . PDO : EXEC - INSERT, UPDATE, DELETE </h2>';

//INSERT
//$resultat = $pdo->exec("INSERT INTO employes VALUES ('', 'arnaud', 'vallette', 'm', 'commercial', '2017-08-20', 4500  )");
//instancie la méthode exec dans une nouvelle variable résultat
//la méthode exec execute la requete et renvoi le nombre de ligne affécté par la requête
echo "Nbre d'enregistrement affecté par l'insert : $resultat";

//UPDATE
$resultat = $pdo->exec("UPDATE employes SET salaire = '1200'  WHERE id_employes = '350'  ");

//DELETE
// supprimer le script permettant de supprimer l'employé
$resultat = $pdo->exec( "DELETE FROM employes WHERE prenom = 'arnaud' ");

/*
 * EXEC() méthode issue de la class PDO permettant de formuler et d'executer des requêtes SQL
 * */

echo '<h2> 03 . PDO : QUERY -SELECT + FETCH_ASSOC (1seul résultat) </h2>';
$resultat = $pdo->query("SELECT * FROM employes WHERE id_employes = 699");
//on obtient un objet d'une autre class PDOStatement  donc autre methode
//donc on appelle fetch qui est une methode de PDOstatement pour le rendre exploitable
echo '<pre>'; var_dump($resultat); echo '</pre>'; //renvoi un autre objet avec d'autres méthodes donc

echo '<pre>'; print_r(get_class_methods($resultat)); echo '<pre>';
//$employe = $resultat->fetch(PDO::FETCH_ASSOC); //voir doc pour la liste des paramètres FETCH
$employe = $resultat->fetch(PDO::FETCH_BOTH); //BOTH index numérique et nom des champs


echo '<pre>'; print_r($employe); echo '<pre>'; //un tableau est renvoyé donc cela rend les données renvoyées exploitables

//exercice : afficher les données de l'employés à laide d'un affichage conventionnel
echo implode('<br>',$employe);
foreach($employe as $indice => $valeur)
{
    echo "$indice : $valeur <br>";
}

echo '<h2> 04 . PDO : QUERY - WHILE + FETCH_ASSOC (plusieurs résultats) </h2>';

$resultat = $pdo->query("SELECT * FROM employes");
//si on veut compter le nombre d'enregistrement renvoyé
echo "Nombres d'employes :" . $resultat->rowCount() . "<br>";
while($tableEmployes = $resultat->fetch(PDO::FETCH_ASSOC)) //un tableau array par tour de boucle
{
    foreach($tableEmployes as $indice => $valeur)
    {
        echo $indice . ' : ' . $valeur . '<br>';

    }
    echo '<hr>';
//    echo '<pre>'; print_r($tableEmployes); echo '</pre>';
}
//Attention , il n'y a pas un tableau avec tous les enregistrements dedans mais un tableau
//Array par enregistrement
//donc il faut utiliser une boucle !!

echo '<h2> 05 . PDO : QUERY FETCHALL + FETCH_ASSOC </h2>';
$resultat = $pdo->query("SELECT * FROM employes");
$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);

//echo '<pre>'; print_r($donnees); echo '</pre>'; // tableau multidimension indéxé

//Exo afficher successivement les données de tous les employés à l'aide de boucles
//et affichage conventionnel

foreach($donnees as $indice1 => $tableau)
{
    echo '<hr>';
    foreach ($tableau as $indice2 => $valeurs)
    {
        echo $valeurs . '<br>';
    }

}