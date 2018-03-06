<?php

require_once ('../inc/init.inc.php');

/*------------------------------------------------------------------------
 *
 *                      SUPPRESSION MEMBRE
 *
--------------------------------------------------------------------------*/
if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
    //requête de suppression en récupérant l'id membre envoyé dans l'url au clic sur le bouton supprimé

    $resultat=$pdo->prepare("DELETE FROM membre WHERE id_membre = :id_membre");
    $resultat->bindValue(':id_membre',$_GET['id_membre'], PDO::PARAM_STR);
    $resultat->execute();

    // une fois la suppression faite on injecte affichage dans l'url pour rester sur l'affichage des membres
    $_GET['action'] = 'affichage';
    $content .= '<div class="alert alert-success text-center">Le membre N° <span class="text-success">' . $_GET['id_membre'] . '</span> a bien été supprimé.</div>';

}
/*------------------------------------------------------------------------
*
*                      REQUETE MODIFICATION MEMBRE
*
--------------------------------------------------------------------------*/
if(!empty($_POST)) //si on a cliqué sur modifier
{

    if (isset($_GET['action']) && $_GET['action'] == 'modification')
    {
        $membre = $pdo->prepare("UPDATE membre SET pseudo = :pseudo, mdp=:mdp, nom=:nom, prenom=:prenom, 
        email=:email, civilite=:civilite, ville=:ville, code_postal=:code_postal, adresse=:adresse, statut=:statut WHERE id_membre = '$_POST[id_membre]'");
        $content .= '<div class="alert alert-success mt-1">Modification avec succès du membre N° :<strong> ' . $_POST['id_membre'] . ' </strong></div>';

        $membre->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $membre->bindValue(':mdp', $_POST['mdp'], PDO::PARAM_STR);
        $membre->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        $membre->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $membre->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $membre->bindValue(':civilite', $_POST['civilite'], PDO::PARAM_STR);
        $membre->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
        $membre->bindValue(':code_postal', $_POST['code_postal'], PDO::PARAM_STR);
        $membre->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_INT);
        $membre->bindValue(':statut', $_POST['statut'], PDO::PARAM_INT);
        $membre->execute();
    }
}
/*------------------------------------------------------------------------
 *
 *                      AFFICHAGE MEMBRE TABLE HTML
 *
--------------------------------------------------------------------------*/

$resultat = $pdo->query('SELECT * FROM membre');
$content .='<div class="row">';
    $content .= '<div class="col mb-1"><h3>Membres</h3>Nombre de clients inscris : <span class="badge badge-primary">' . $resultat->rowCount() . '</span></div>';


    $content .='<div class="table-responsive"><table class="table">';
            //entête du tableau
            $content .= '<thead><tr>';
                for ($i = 0; $i < $resultat->columnCount(); $i++) {
                $colonne = $resultat->getColumnMeta($i);
                $content .= '<th scope="col">' . $colonne['name'] . '</th>';
                }
                $content .= '<th>Modification</th>';
                $content .= '<th>Suppression</th>';
                $content .= '</tr></thead>';
            //corps du tableau
            $content .= '<tbody>';

            //while pour créer une ligne par résultat
            while ($tablemembre=$resultat->fetch(PDO::FETCH_ASSOC)) {

            $content .= '<tr>';
                foreach ($tablemembre as $indice => $info) {
                    $content .= '<td>' . $info . '</td>';
                }
                //ajout des glyphicons de suppr et modification
                $content .= '<td class="text-center"><a href="?action=modification&id_membre='. $tablemembre['id_membre'] .'"><span class=""><i class="fas fa-pencil-alt"></i></span></a></td>';
                $content .= '<td class="text-center"><a href="?action=suppression&id_membre='. $tablemembre['id_membre'] .'" onclick="return(confirm(\'En êtes vous certain?\'))"><span class=""><i class="far fa-trash-alt"></i></span></a></td>';

                $content .= '</tr>';
            }
            $content .= '</tbody>';
            $content .= '</table></div>';

    $content .= '</div>';



require_once ('../inc/header.inc.php');

echo $content;





/*------------------------------------------------------------------------
 *
 *                      AFFICHAGE VOLET MODIFICATION FICHE MEMBRE
 *
--------------------------------------------------------------------------*/
//condition ajout ou modification récupérée en GET dans l'url au clic des différents boutons
if(isset($_GET['action']) &&  $_GET['action'] == 'modification') {

    if(isset($_GET['id_membre']))
    {
        $resultat = $pdo->prepare("SELECT * FROM membre WHERE id_membre = :id_membre");
        $resultat->bindValue(':id_membre',$_GET['id_membre'], PDO::PARAM_STR);
        $resultat->execute();
        //retourne un objet avec les données du membre
        $membre_actuel = $resultat->fetch(PDO::FETCH_ASSOC);

    }
    //si l'id membre a été selectionné echo de l'id sinon vide
    $id_membre =   (isset($membre_actuel['id_membre'])) ? $membre_actuel['id_membre'] : '';
    $pseudo =   (isset($membre_actuel['pseudo'])) ? $membre_actuel['pseudo'] : '';
    $mdp =   (isset($membre_actuel['mdp'])) ? $membre_actuel['mdp'] : '';
    $nom =       (isset($membre_actuel['nom'])) ? $membre_actuel['nom'] : '';
    $prenom = (isset($membre_actuel['prenom'])) ? $membre_actuel['prenom'] : '';
    $email =     (isset($membre_actuel['email'])) ? $membre_actuel['email'] : '';
    $civilite =      (isset($membre_actuel['civilite'])) ? $membre_actuel['civilite'] : '';
    $ville =      (isset($membre_actuel['ville'])) ? $membre_actuel['ville'] : '';
    $code_postal =       (isset($membre_actuel['code_postal'])) ? $membre_actuel['code_postal'] : '';
    $adresse =        (isset($membre_actuel['adresse'])) ? $membre_actuel['adresse'] : '';
    $statut =       (isset($membre_actuel['statut'])) ? $membre_actuel['statut'] : '';

    echo '
<!-- FORMULAIRE INSERTION MEMBRE-->
<div class="row my-5">
    <div class="col">
        <h2>' . ucfirst($_GET['action']) . ' de la fiche membre</h2>
        <form class="row" method="post" action="" enctype="multipart/form-data">
            <!--soumission de lID membre en hidden car non modifiable et permet la requête de MAJ -->
            <div class="form-group">
                <input type="hidden" id="id_membre" name="id_membre" value="'. $id_membre . '">
            </div>
            
            <div class="form-group col-6">
                <label for="reference">Pseudo</label>
                <input type="text" class="form-control" id="pseudo"  name="pseudo" placeholder="Saisir votre pseudo" value="' .  $pseudo . '"> </div> <div class="form-group col-6">
                <label for="mdp">Mot de passe</label>
                <input type="text" class="form-control" id="mdp" name="mdp" placeholder="Saisir votre mot de passe" value="' .  $mdp . '">
            </div>
            <div class="form-group col-6">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Saisir votre nom" value="' .  $nom . '">
            </div>
            <div class="form-group col-6">
                <label for="prenom">Prenom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Saisir votre prenom" value="' .  $prenom . '">
            </div>
            <div class="form-group col-6">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Saisir votre email" value="' .  $email . '">
            </div>
            
            <div class="form-group col-6">
                <label for="civilite">Civilite</label>
                <select class="form-control" id="civilite" name="civilite">
                    <option '; if($civilite == "m") echo "selected"; echo 'value="m">M</option>
                    <option '; if($civilite == "f") echo "selected"; echo 'value="f">Mme</option>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="ville">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" placeholder="Saisir votre ville" value="' .  $ville . '">
            </div>
        
            <div class="form-group col-6">
                <label for="code_postal">Code Postal</label>
                <input type="number" class="form-control" id="code_postal" name="code_postal" placeholder="Saisir le code postal" value="' .  $code_postal . '">
            </div>
            <div class="form-group col-6">
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" value="' .  $adresse . '">
            </div>
            <div class="form-group col-6">
                <label for="statut">Admin</label>
                <select class="form-control" id="statut" name="statut">
                    <option '; if($statut == "1") echo "selected"; echo ' value="1">Admin</option>
                    <option '; if($statut == "0") echo "selected"; echo ' value="0">Client</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary" >' . ucfirst($_GET['action']) . ' de la fiche</button>
            </div>
        </form>
    </div>
</div>';
} //FIN DE L'AFFICHAGE FORM MODIF MEMBRE



require_once ('../inc/footer.inc.php');

?>
