<?php
//CONNEXION A LA BDD
$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//REQUETE DE RECUPERATION DES INFORMATIONS GRACE A PDO

$resultat = $pdo->query('SELECT title, director, year_of_prod FROM movies');


echo '
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Gestion films</title>
  </head>
  <body>
    <table class="table">
        <thead class="thead-dark">
            <tr>
              <th scope="col">Titre</th>
              <th scope="col">Réalisateur</th>
              <th scope="col">Année de production</th>
              <th scope="col">Détails</th>
            </tr>
        </thead>
        <tbody>';

//--on boucle sur chacun des tableaux renvoyer par la méthode fetch 1 tableau = 1 film
while ($listeFilms = $resultat->fetch(PDO::FETCH_ASSOC)) {
    //pour chaque film on créé une ligne
    echo '<tr>';

    //on parcourt chaque film et on fait une cellule par info
    foreach ($listeFilms as $colonne => $info) {
        echo '<td> ' . $info . ' </td>';
    }
    //---envoi du titre du film dans la page détail par la méthode GET
    echo '<td><a href="ex3-details.php?titre=' . $listeFilms["title"] . '">plus d\'infos</a></td>';
    echo '</tr>';

}
echo '</tbody></table>
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
';

?>





