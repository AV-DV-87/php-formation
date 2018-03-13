<?php

require_once ('../inc/init.inc.php');

/*------------------------------------------------------------------------
 *
 *                      SUPPRESSION COMMANDE
 *
--------------------------------------------------------------------------*/
if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
    //requête de suppression en récupérant l'id commande envoyé dans l'url au clic sur le bouton supprimé

    $resultat=$pdo->prepare("DELETE FROM commande WHERE id_commande = :id_commande");
    $resultat->bindValue(':id_commande',$_GET['id_commande'], PDO::PARAM_STR);
    $resultat->execute();

    // une fois la suppression faite on injecte affichage dans l'url pour rester sur l'affichage des commandes
    $_GET['action'] = 'affichage';
    $content .= '<div class="alert alert-success text-center">Le commande N° <span class="text-success">' . $_GET['id_commande'] . '</span> a bien été supprimé.</div>';

}
/*------------------------------------------------------------------------
*
*                      REQUETE MODIFICATION commande
*
--------------------------------------------------------------------------*/
if(!empty($_POST)) //si on a cliqué sur modifier
{

    if (isset($_GET['action']) && $_GET['action'] == 'modification')
    {
        $commande = $pdo->prepare("UPDATE commande SET pseudo = :pseudo, mdp=:mdp, nom=:nom, prenom=:prenom, 
        email=:email, civilite=:civilite, ville=:ville, code_postal=:code_postal, adresse=:adresse, statut=:statut WHERE id_commande = '$_POST[id_commande]'");
        $content .= '<div class="alert alert-success mt-1">Modification avec succès du commande N° :<strong> ' . $_POST['id_commande'] . ' </strong></div>';

        $commande->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $commande->bindValue(':mdp', $_POST['mdp'], PDO::PARAM_STR);
        $commande->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        $commande->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $commande->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $commande->bindValue(':civilite', $_POST['civilite'], PDO::PARAM_STR);
        $commande->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
        $commande->bindValue(':code_postal', $_POST['code_postal'], PDO::PARAM_STR);
        $commande->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_INT);
        $commande->bindValue(':statut', $_POST['statut'], PDO::PARAM_INT);
        $commande->execute();
    }
}
/*------------------------------------------------------------------------
 *
 *                      AFFICHAGE commande TABLE HTML
 *
--------------------------------------------------------------------------*/

$resultat = $pdo->query('SELECT id_commande, prenom, nom, email, adresse, montant, etat FROM commande c, membre m WHERE c.id_membre = m.id_membre');
$content .='<div class="row">';
$content .= '<div class="col mb-1"><h3>Commandes</h3>Nombre de commandes : <span class="badge badge-primary">' . $resultat->rowCount() . '</span></div>';


$content .='<div class="table-responsive"><table class="table">';
//entête du tableau
$content .= '<thead><tr>';
for ($i = 0; $i < $resultat->columnCount(); $i++) {
    $colonne = $resultat->getColumnMeta($i);
    $content .= '<th scope="col">' . $colonne['name'] . '</th>';
}

$content .= '<th>Détails</th>';
$content .= '<th>Etat</th>';
$content .= '<th>Modification</th>';
$content .= '<th>Suppression</th>';
$content .= '</tr></thead>';
//corps du tableau
$content .= '<tbody>';

//while pour créer une ligne par résultat
while ($tablecommande=$resultat->fetch(PDO::FETCH_ASSOC)) {
    var_dump( $tablecommande);
    $content .= '<tr>';
    foreach ($tablecommande as $indice => $info) {
        $content .= '<td>' . $info . '</td>';
    }
    //ajout des glyphicons de suppr et modification
    $content .= '<td class="text-center"><a href="?action=details&id_commande='. $tablecommande['id_commande'] .'"><span class=""><i class="fas fa-search-plus"></i></span></a></td>';
    $content .= '<td class="text-center"><div class="form-group col-6">
                <select class="form-control" id="etat" name="statut">
                    <option 'if($tablecommande["etat"] == "en cours de traitement"){ echo "selected";}' value="en cours de traitement">En cours de traitement</option>
                </select>
            </div></td>';
    $content .= '<td class="text-center"><a href="?action=modification&id_commande='. $tablecommande['id_commande'] .'"><span class=""><i class="fas fa-pencil-alt"></i></span></a></td>';
    $content .= '<td class="text-center"><a href="?action=suppression&id_commande='. $tablecommande['id_commande'] .'" onclick="return(confirm(\'En êtes vous certain?\'))"><span class=""><i class="far fa-trash-alt"></i></span></a></td>';

    $content .= '</tr>';
}
$content .= '</tbody>';
$content .= '</table></div>';

$content .= '</div>';



require_once ('../inc/header.inc.php');

echo $content;





/*------------------------------------------------------------------------
 *
 *                      AFFICHAGE VOLET MODIFICATION FICHE commande
 *
--------------------------------------------------------------------------*/
//condition ajout ou modification récupérée en GET dans l'url au clic des différents boutons
if(isset($_GET['action']) &&  $_GET['action'] == 'modification') {

    if(isset($_GET['id_commande']))
    {
        $resultat = $pdo->prepare("SELECT * FROM commande WHERE id_commande = :id_commande");
        $resultat->bindValue(':id_commande',$_GET['id_commande'], PDO::PARAM_STR);
        $resultat->execute();
        //retourne un objet avec les données du commande
        $commande_actuel = $resultat->fetch(PDO::FETCH_ASSOC);

    }
    //si l'id commande a été selectionné echo de l'id sinon vide
    $id_commande =   (isset($commande_actuel['id_commande'])) ? $commande_actuel['id_commande'] : '';
    $pseudo =   (isset($commande_actuel['pseudo'])) ? $commande_actuel['pseudo'] : '';
    $mdp =   (isset($commande_actuel['mdp'])) ? $commande_actuel['mdp'] : '';
    $nom =       (isset($commande_actuel['nom'])) ? $commande_actuel['nom'] : '';
    $prenom = (isset($commande_actuel['prenom'])) ? $commande_actuel['prenom'] : '';
    $email =     (isset($commande_actuel['email'])) ? $commande_actuel['email'] : '';
    $civilite =      (isset($commande_actuel['civilite'])) ? $commande_actuel['civilite'] : '';
    $ville =      (isset($commande_actuel['ville'])) ? $commande_actuel['ville'] : '';
    $code_postal =       (isset($commande_actuel['code_postal'])) ? $commande_actuel['code_postal'] : '';
    $adresse =        (isset($commande_actuel['adresse'])) ? $commande_actuel['adresse'] : '';
    $statut =       (isset($commande_actuel['statut'])) ? $commande_actuel['statut'] : '';

    echo '
<!-- FORMULAIRE INSERTION commande-->
<div class="row my-5">
    <div class="col">
        <h2>' . ucfirst($_GET['action']) . ' de la fiche commande</h2>
        <form class="row" method="post" action="" enctype="multipart/form-data">
            <!--soumission de lID commande en hidden car non modifiable et permet la requête de MAJ -->
            <div class="form-group">
                <input type="hidden" id="id_commande" name="id_commande" value="'. $id_commande . '">
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
} //FIN DE L'AFFICHAGE FORM MODIF commande



require_once ('../inc/footer.inc.php');

?>