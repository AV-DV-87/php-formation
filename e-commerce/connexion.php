<?php
require_once ("inc/init.inc.php");

if(isset($_GET['action']) && $_GET['action'] == 'deconnexion')
{
    session_destroy();
}


//si l'internaute reviens sur connexion alors qu'il est déjà connecté direction profil.php
if (internauteEstConnecte())
{
    header('location:profil.php');
}

if($_POST)
{
    $resultat = $pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");
    if($resultat->rowCount() != 0)
    {
        $membre = $resultat->fetch(PDO::FETCH_ASSOC);


        //        password_verify($_POST['mdp'], $membre['mdp']) pour décrypter un password hash

        if ($membre['mdp'] == $_POST['mdp'])
        {
            $content .= "<div class='alert alert-success mt-1'> Bienvenue parmis nous $membre[prenom] </div>";
            //stockage des informations utilisateurs en session sauf le mdp bien sûr
            foreach ($membre as $indice => $valeur) //parcours les infos du membre qui a le bon pseudo et mdp
            {
                if($indice != 'mdp')
                {
                    $_SESSION['membre'][$indice] = $valeur; //création du fichier session un tableau membre et on enregistre
                    //les données de l'internautes donc il restera connecté sur l'ensemble du site
                }

            }
//            debug($_SESSION);
//          redirection vers profil.php si les infos sont ok
            header("location:profil.php");
        }
        else //si mauvais mot de passe
        {
            $content .= '<div class="alert alert-danger mt-2">Mauvais mot de passe</div>';
        }
    }
    else //si mauvais pseudo
    {
        $content .= '<div class="alert alert-danger mt-2">Erreur de pseudo</div>';
    }

}

require_once ("inc/header.inc.php");
echo $content;

?>
<div class="row align-items-center inscription">

    <form method="post" class="col-sm-6 offset-sm-3 align-middle">
        <h2 class="text-center text-white bg-primary rounded py-1">CONNEXION</h2>
        <div class="form-group">
            <label for="pseudo">Email</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Votre pseudo">
        </div>
        <div class="form-group">
            <label for="mdp">Mot de passe</label>
            <input type="mdp" class="form-control" id="mdp" name="mdp" placeholder="Votre mot de passe">
        </div>
        <button type="submit" class="btn btn-primary">Connexion</button>
    </form>
</div>


<?php
require_once ("inc/footer.inc.php");
?>
