<?php

//vérification que la superglobale post est bien généré par l'envoi du formulaire
//print_r($_POST);

//CREATION D'UNE CONNEXION à NOTRE BDD gràce à la classe PDO

$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//CONTROLE DES INFORMATIONS DU FORMULAIRES

//---ajout d'une variable content qui servira à récupérer et afficher les messages
$content = '';

//---à l'envoi du formulaire par la méthode post
if ($_POST) {
    //----Contrôles du nombre de caractères sur 5 champs
    if (strlen($_POST['title']) < 5) {
        $content .= '<div class="alert alert-danger">Le titre doit comporter au moins 5 caractères.</div>';
    }
    if (strlen($_POST['director']) < 5) {
        $content .= '<div class="alert alert-danger">Le nom du réalisateur doit comporter au moins 5 caractères.</div>';
    }
    if (strlen($_POST['actors']) < 5) {
        $content .= '<div class="alert alert-danger">Le champs acteurs doit comporter au moins 5 caractères.</div>';
    }
    if (strlen($_POST['producer']) < 5) {
        $content .= '<div class="alert alert-danger">Le nom du producteur doit comporter au moins 5 caractères.</div>';
    }
    if (strlen($_POST['storyline']) < 5) {
        $content .= '<div class="alert alert-danger">Le synopsis doit comporter au moins 5 caractères.</div>';
    }

    //----si le champs vidéo n'est pas une url valide
    if (!filter_var($_POST['video'], FILTER_VALIDATE_URL)) {
        $content .= '<div class="alert alert-danger">L\'url de la vidéo est invalide.</div>';
    }
    //FIN DES CONTROLES

    //PROCEDURE D'ENVOI A LA BDD si $content ne contient pas d'erreur nous allons faire une requête pour ajouter le film
    //en Base de données

    if (empty($content)) {
        //préparation de la requête pour sécuriser le formulaire
        $film = $pdo->prepare("INSERT INTO movies(title, actors, director, producer, year_of_prod, language, 
        category, storyline, video) VALUES (:title, :actors, :director, :producer, :year_of_prod, :language, 
        :category, :storyline, :video)");
        $film->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
        $film->bindValue(':actors', $_POST['actors'], PDO::PARAM_STR);
        $film->bindValue(':director', $_POST['director'], PDO::PARAM_STR);
        $film->bindValue(':producer', $_POST['producer'], PDO::PARAM_STR);
        $film->bindValue(':year_of_prod', $_POST['year_of_prod'], PDO::PARAM_INT);
        $film->bindValue(':language', $_POST['language'], PDO::PARAM_STR);
        $film->bindValue(':category', $_POST['category'], PDO::PARAM_STR);
        $film->bindValue(':storyline', $_POST['storyline'], PDO::PARAM_STR);
        $film->bindValue(':video', $_POST['video'], PDO::PARAM_STR);

        $film->execute();

        $content .= '<div class="alert alert-success">Le film ' . $_POST['title'] . ' a bien été ajouté</div>';
    }


    echo $content;
}


//Affichage du formulaire en Bootstrap 4
echo
'
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Gestion films</title>
  </head>
  <body>
    <div class="row">
        <h1 class="mx-auto">Ajouter un film</h1>
    </div>
    <div class="row">
        <!--FORMULAIRE AJOUT DE FILMS-->
        <div class="col-sm-6 offset-3">
            <form method="POST">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Titre du film">
                </div>
                <div class="form-group">
                    <label for="actors">Acteurs</label>
                    <input type="text" class="form-control" id="actors" name="actors" placeholder="Les acteurs">
                </div>
                <div class="form-group">
                    <label for="director">Réalisateur</label>
                    <input type="text" class="form-control" id="director" name="director" placeholder="Réalisateur">
                </div>
                <div class="form-group">
                    <label for="producer">Producteur</label>
                    <input type="text" class="form-control" id="producer" name="producer" placeholder="Producteur">
                </div>
                <div class="form-group">
                    <label for="year_of_prod">Année de sortie</label>
                    <select type="text" class="form-control" id="year_of_prod" name="year_of_prod" 
                    placeholder="Année de sortie">';
                        //boucle d'affichage des années de 2020 à 1971
                        for ($i = 2020; $i > 1970; $i--) {
                            echo "<option>$i</option>";
                        }
                        echo '
                    </select>
                </div>
                <div class="form-group">
                    <label for="language">Langue</label>
                    <select type="text" class="form-control" id="language" name="language" placeholder="Langue">
                        <option>Anglais</option>
                        <option>Français</option>
                        <option>Allemand</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Catégorie</label>
                    <select type="text" class="form-control" id="category" name="category" placeholder="Catégorie">
                        <option>Action</option>
                        <option>Horreur</option>
                        <option>Romantique</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="storyline">Synopsis</label>
                    <input type="text" class="form-control" id="storyline" name="storyline" placeholder="Synopsis">
                </div>
                <div class="form-group">
                    <label for="video">URL de la vidéo</label>
                    <input type="text" class="form-control" id="video" name="video" placeholder="lien vers la vidéo">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Enregistrer</button>
            </form>
        </div>      
    </div>
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

';
