<?php
require_once("inc/init.inc.php");

//debug($_POST,2);
/*
 * Contrôle des champs:
 * -contrôler la disponibilité du pseudo
 * -contrôler la taille des champs : pseudo nom prenom : entre 4 et 20 caractère
 * -contrôler le code postal soit de type numérique est de 5 carac
 * -contrôler la validité du champs email
 *
 */

//controle
$content = '';
if($_POST)
{
    $erreur = '';
    $verif_pseudo = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
    $verif_pseudo->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
    $verif_pseudo->execute();

    if ($verif_pseudo->rowCount() > 0) //compte le nombre de ligne renvoyées par la requête
    {
        $erreur .= '<div class="alert alert-danger mt-2">Ce pseudo existe déjà</div>';
    }
    if (strlen($_POST['pseudo']) < 2 || strlen($_POST['pseudo']) > 20)
    {
        $erreur .= '<div class="alert alert-danger mt-2">Le pseudo doit faire entre 2 et 20 caractères</div>';
    }
    if (strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20)
    {
        $erreur .= '<div class="alert alert-danger mt-2">Le nom doit faire entre 2 et 20 caractères</div>';
    }
    if (strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20)
    {
        $erreur .= '<div class="alert alert-danger mt-2">Le prénom doit faire entre 2 et 20 caractères</div>';
    }
    if (!is_numeric($_POST['code_postal']) || strlen($_POST['code_postal']) !== 5)
    {
        $erreur .= '<div class="alert alert-danger mt-2">Veuillez saisir un mdp valide</div>';
    }
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $erreur .= '<div class="alert alert-danger mt-2">Veuillez saisi un email valide</div>';
    }
    //si l'erreur est vide on peut executer le script permettant d'ajouter un membre
    $content .= $erreur;
    if(empty($erreur))
    {
        //TOUJOURS hacher le mdp avant de le stocker
//        $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

        $membre = $pdo->prepare("INSERT INTO membre(pseudo,mdp,nom,prenom, email, civilite,
ville, code_postal, adresse) VALUES (:pseudo,:mdp,:nom,:prenom,:email,:civilite,:ville,:code_postal,:adresse )");
        $membre->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $membre->bindValue(':mdp', $_POST['mdp'], PDO::PARAM_STR);
        $membre->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        $membre->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $membre->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $membre->bindValue(':civilite', $_POST['civilite'], PDO::PARAM_STR);
        $membre->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
        $membre->bindValue(':code_postal', $_POST['code_postal'], PDO::PARAM_STR);
        $membre->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);

        $membre->execute();

        $content .= '<div class="alert alert-success mt-1">Bienvenue parmis nous ! Vous pouvez vous <a href="connexion.php">ICI</a></div>';

    }



}
require_once('inc/header.inc.php');
echo $content;


?>

    <!---Formulaire pour ajouter un membre--->
    <h2 class="text-center text-white bg-primary py-1 mt-2">INSCRIPTION</h2>
    <form class="py-3" method="post">
        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Saisir votre pseudo">
        </div>
        <div class="form-group">
            <label for="mdp">Mot de passe</label>
            <input type="text" class="form-control" id="mdp" name="mdp" placeholder="Saisir votre mdp">
        </div>
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Saisir votre nom">
        </div>
        <div class="form-group">
            <label for="prenom">Prenom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Saisir votre prenom">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Saisir votre email">
        </div>
        <div class="form-group">
            <label for="civilite">Civilité</label>
            <select class="form-control" id="civilite" name="civilite" placeholder="Saisir votre civilite">
                <option value="m">H</option>
                <option value="f">F</option>
            </select>
        </div>
        <div class="form-group">
            <label for="ville">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville" placeholder="Saisir votre ville">
        </div>
        <div class="form-group">
            <label for="code_postal">Code Postal</label>
            <input type="text" class="form-control" id="code_postal" name="code_postal"
                   placeholder="Saisir votre code postal">
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Saisir votre adresse">
        </div>

        <button type="submit" class="btn btn-primary">Inscription</button>
    </form>


<?php
require_once('inc/footer.inc.php');

?>