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
//fetchall renvoi un tableau multi dimension avec un tableau pour chaque employé pas besoin de boucler
//echo '<pre>'; print_r($donnees); echo '</pre>'; // tableau multidimension indéxé

//Exo afficher successivement les données de tous les employés à l'aide de boucles
//et affichage conventionnel

foreach($donnees as $indice1 => $tableau)
{
    echo '<hr>';
    foreach ($tableau as $indice2 => $valeurs)
    {
        echo "$indice2 : $valeurs  <br>";
    }

}


echo '<h2> 06 . PDO QUERY - FETCH ET BDD </h2>';

//exercice la liste des bases de données puis la mettre dans une liste ul li
$resultat = $pdo->query("SHOW DATABASES");
echo '<pre>'; var_dump($resultat); echo '<pre>';
$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>'; var_dump($donnees); echo '<pre>';
echo '<ul>';
foreach ($donnees as $donnee => $BDD) {
    foreach ($BDD as $indice =>$nom)
    {
        echo "<li> $nom </li>";
    }
}
echo '</ul>';

echo '<h2> 07 . PDO QUERY - QUERY ET TABLE </h2>';
//afficher la table avec une mise en forme de tableau HTML
$resultat = $pdo->query("SELECT * FROM employes");



//LE TABLEAU
echo '<table border=1><tr>';
for($i = 0; $i < $resultat->columnCount(); $i++)
    //la boucle va tourner jusqu'à avoir parcouru toutes les colonnes de $resultat
{
    $colonne = $resultat->getColumnMeta($i); //récupère les entêtes des colonnes avec getColumnMeta
//    echo '<pre>'; print_r($colonne); echo '</pre>';
    echo '<td>' . $colonne['name'] . '</td>';

}
echo '</tr>';


while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC))
//ATTENTION on ne peut pas associer deux fois la même méthode sur le même résultat PDO::FETCH_ASSOC
{
    echo '<tr>';
    foreach ($ligne as $informations)
    {
        echo '<td>' . $informations . '</td>';
    }
    echo '</tr>';
}


echo '</table>';

echo '<h2> 08 . PDO : PREPARE + BINDVALUE + EXECUTE </h2>';
//améliore la performance en préparant à l'avance des requêtes

$nom = "Collier";
$resultat = $pdo->prepare('SELECT * FROM employes WHERE nom= :nom');
//marqueur nominatif :nom qui peut être changé à tout moment pour executer la requête
//soulage le SERVER et la BDD + sécurise la requete donc evite l'injections de SQL ou faille XSS

//CONTROLES
echo '<pre>'; print_r($resultat); echo '</pre>';
echo '<pre>'; print_r(get_class_methods($resultat)); echo '</pre>';

//on associe une variable (déjà déclarée en haut) à notre marqueur nominatif pour pouvoir éxécuter la requête
$resultat->bindValue(':nom', $nom, PDO::PARAM_STR);
//execution de la requete avec $nom à la place de :nom
$resultat->execute();

$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($donnees); echo '</pre>';

//on peut relancer BindValue avec une nouvelle valeur $name pour executer de nouveau la requête
