<?php
//CONNEXION A LA BDD
$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


//---Si mon paramètre GET a bien été envoyé dans l'url je fais une requête pour
//---récupérer toutes les infos du films correspondant
if (isset($_GET['titre'])) {

    $resultat = $pdo->prepare('SELECT * FROM movies WHERE title = :title');
    $resultat->bindValue(':title', $_GET['titre'], PDO::PARAM_STR);
    $resultat->execute();

    //---tableau d'information du film
    $film=$resultat->fetch(PDO::FETCH_ASSOC);



//---Affichage HTML
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
        <div class="row">
        <h1 class="mx-auto">Détails du film</h1>
        </div>
        <div class="row">
            
            <!--FICHE DU FILM-->
            <div class="col-sm-6 offset-3">
               <ul class="list-group">
                  ';
                    //on parcours le tableau et on crée une ligne par info sauf pour l'id
                    foreach ($film as $indice=>$info)
                    {
                        if($indice!='id_film') {
                            echo '<li class="list-group-item">' . $indice . " : " . $info . '</li>';
                        }
                    }
                  echo '
               </ul> 
            </div>      
        </div>
        
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      </body>
    </html>';} // fin de la condition $_GET

//----si une personne tente d'accéder à la page sans avoir cliqué sur plus d'infos = erreur et lien de retour à la liste
else
{
    echo '<div style="color:red">Ce film n\'existe pas. Veuillez retourner à la <a href="ex3-listfilms.php">liste des films</a></div>';
}
                ?>