<?php
require_once ("../inc/init.inc.php");
//bloquer l'accès au non admin
if (!internauteEstConnecteEtAdmin()) //si pas admin redirection connexion.php
{
    header("location:". URL ."connexion.php");
}

//SUPPRESSION PRODUIT
if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
    //requête de suppression en récupérant l'id produit envoyé dans l'url au clic sur le bouton supprimé

    $resultat=$pdo->prepare("DELETE FROM produit WHERE id_produit = :id_produit");
    $resultat->bindValue(':id_produit',$_GET['id_produit'], PDO::PARAM_STR);
    $resultat->execute();

    // une fois la suppression faite on injecte affichage dans l'url pour rester sur l'affichage des produits
    $_GET['action'] = 'affichage';
    $content .= '<div class="alert alert-success text-center">Le produit N° <span class="text-success">' . $_GET['id_produit'] . '</span> a bien été supprimé.</div>';

}


//ENREGISTREMENT PRODUIT
if(!empty($_POST))
{


        $photo_bdd = '';

        if(isset($_GET['action']) && $_GET['action'] == 'modification')
        {
            //si on garde la valeur photo du champs hidden c'est à dire celle de l'url selectionnée en BDD
            $photo_bdd = $_POST['photo_actuelle'];
        }

        if(!empty($_FILES['photo']['name']))
        {
            //concatenation de la reference et du nom de la photo
            $nom_photo = $_POST['reference'] . '-' . $_FILES['photo']['name'];

            //stockage de la photo dans notre dossier en insérant le nom ref + photo

            //        echo $photo_bdd;
            $photo_bdd = URL . "photo/$nom_photo";

            //chemin physique
            $photo_dossier = RACINE_SITE ."photo/$nom_photo";

            //        echo $photo_dossier;
            copy($_FILES['photo']['tmp_name'],$photo_dossier);
        }

        //INNSERT NOUVEAU PRODUIT SI ACTION EST AJOUT
        if(isset($_GET['action']) && $_GET['action'] == 'ajout')
        {
            $erreur = '';

            //---Verification de la référence (unique sur la BDD
            $referencedispo =$pdo->prepare("SELECT * FROM produit WHERE reference = :reference");
            $referencedispo->bindValue(':reference', $_POST['reference'], PDO::PARAM_STR);
            $referencedispo->execute();
            if ($referencedispo->rowCount() > 0)
            {
                $erreur .= '<div class="alert alert-danger mt-2">Cette référence existe déjà</div>';
            }
            $content .= $erreur;
            if(empty($erreur)) {

                $produit = $pdo->prepare("INSERT INTO produit(reference, categorie, titre, 
            description, couleur, taille, public, photo, prix, stock) VALUES (:reference, :categorie, :titre, 
            :description, :couleur, :taille, :public, :photo, :prix, :stock)");

                $content .= '<div class="alert alert-success mt-1">Produit enregistré avec succès Référence :<strong> ' . $_POST['reference'] . ' </strong></div>';
            }
        }
        //l'autre cas sera une modification UPDATE
        else
        {
            $produit = $pdo->prepare("UPDATE produit SET reference = :reference, categorie= :categorie, titre=:titre,
            description=:description,couleur=:couleur,taille=:taille,public=:public,photo=:photo,prix=:prix,stock=:stock WHERE id_produit = '$_POST[id_produit]'");
            $content .= '<div class="alert alert-success mt-1">Produit modifié avec succès Référence :<strong> ' . $_POST['reference'] . ' </strong></div>';
        }

        if(empty($erreur)) {
            $produit->bindValue(':reference', $_POST['reference'], PDO::PARAM_STR);
            $produit->bindValue(':categorie', $_POST['categorie'], PDO::PARAM_STR);
            $produit->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
            $produit->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
            $produit->bindValue(':couleur', $_POST['couleur'], PDO::PARAM_STR);
            $produit->bindValue(':taille', $_POST['taille'], PDO::PARAM_STR);
            $produit->bindValue(':public', $_POST['public'], PDO::PARAM_STR);
            $produit->bindValue(':photo', $photo_bdd, PDO::PARAM_STR);
            $produit->bindValue(':prix', $_POST['prix'], PDO::PARAM_INT);
            $produit->bindValue(':stock', $_POST['stock'], PDO::PARAM_INT);
            $produit->execute();
        }





} //fin du empty POST

//---LIENS PRODUITS
$content .= '<div class="list-group my-5 mx-auto col-6" >';
$content .= '<h3 class="list-group-item active text-center">BACK OFFICE</h3>';
$content .= '<a href="?action=affichage" class="list-group-item text-center">Affichage des produits</a>';
$content .= '<a href="?action=ajout" class="list-group-item text-center">Ajout Produit</a>';
$content .= '</div><hr>';

/*
 * AFFICHAGE DE LA TABLE PRODUIT
 */
//récupération du get si action sur
if (isset($_GET['action']) && $_GET['action'] == 'affichage')
{
//affichage de la table produit sous forme de table HTML
$resultat =$pdo->query('SELECT * FROM produit');
$content .='<div class="row">';
$content .= '<div class="col mb-1"><h3>Produits</h3>Nombre de produit(s) dans la boutique : <span class="badge badge-primary">' . $resultat->rowCount() . '</span></div>';


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
while ($tableproduit=$resultat->fetch(PDO::FETCH_ASSOC)) {

    $content .= '<tr>';
    //
    foreach ($tableproduit as $indice => $info) {
        //affichage de la cellule spécifique à l'aperçu photo
        if ($indice == 'photo'){
            $content .='<td><img src="'. $info .'" width="50" height="50"></td>';
        }
        //si pas photo = affichage classique
        else
        {
            $content .= '<td>' . $info . '</td>';
        }
    }
    //ajout des glyphicons de suppr et modification
    $content .= '<td class="text-center"><a href="?action=modification&id_produit='. $tableproduit['id_produit'] .'"><span class=""><i class="fas fa-pencil-alt"></i></span></a></td>';
    $content .= '<td class="text-center"><a href="?action=suppression&id_produit='. $tableproduit['id_produit'] .'" onclick="return(confirm(\'En êtes vous certain?\'))"><span class=""><i class="far fa-trash-alt"></i></span></a></td>';

    $content .= '</tr>';
}
$content .= '</tbody>';
$content .= '</table></div>';

$content .= '</div>';
}// fin de la condition affichage


require_once ("../inc/header.inc.php");
echo $content;

//condition d'affichage produit
//condition ajout ou modification récupérée en GET dans l'url au clic des différents boutons
if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification')) {

    if(isset($_GET['id_produit']))
    {
        $resultat = $pdo->prepare("SELECT * FROM produit WHERE id_produit = :id_produit");
        $resultat->bindValue(':id_produit',$_GET['id_produit'], PDO::PARAM_STR);
        $resultat->execute();
        //retourne un objet avec les données du produit
        $produit_actuel = $resultat->fetch(PDO::FETCH_ASSOC);
        debug($produit_actuel);
    }
    //si l'id produit a été selectionné echo de l'id sinon vide
    $id_produit = (isset($produit_actuel['id_produit'])) ? $produit_actuel['id_produit'] : '';
    $reference = (isset($produit_actuel['reference'])) ? $produit_actuel['reference'] : '';
    $categorie = (isset($produit_actuel['categorie'])) ? $produit_actuel['categorie'] : '';
    $titre = (isset($produit_actuel['titre'])) ? $produit_actuel['titre'] : '';
    $description = (isset($produit_actuel['description'])) ? $produit_actuel['description'] : '';
    $couleur = (isset($produit_actuel['couleur'])) ? $produit_actuel['couleur'] : '';
    $taille = (isset($produit_actuel['taille'])) ? $produit_actuel['taille'] : '';
    $public = (isset($produit_actuel['public'])) ? $produit_actuel['public'] : '';
    $photo = (isset($produit_actuel['photo'])) ? $produit_actuel['photo'] : '';
    $prix = (isset($produit_actuel['prix'])) ? $produit_actuel['prix'] : '';
    $stock = (isset($produit_actuel['stock'])) ? $produit_actuel['stock'] : '';


    echo '
<!-- FORMULAIRE INSERTION PRODUIT-->
<div class="row my-5">
    <div class="col">
        <h2>' . ucfirst($_GET['action']) . ' Produit</h2>
        <form class="row" method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" id="id_produit" name="id_produit" value="'. $id_produit . '">
            </div>
            <div class="form-group col-6">
                <label for="reference">Reference</label>
                <input type="text" class="form-control" id="reference"  name="reference" placeholder="Saisir votre reference" value="' .  $reference . '"> </div> <div class="form-group col-6">
                <label for="categorie">Categorie</label>
                <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Saisir votre categorie" value="' .  $categorie . '">
            </div>
            <div class="form-group col-6">
                <label for="titre">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" placeholder="Saisir votre titre" value="' .  $titre . '">
            </div>
            <div class="form-group col-6">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Saisir votre description" value="' .  $description . '">
            </div>
            <div class="form-group col-6">
                <label for="couleur">Couleur</label>
                <input type="text" class="form-control" id="couleur" name="couleur" placeholder="Saisir votre couleur" value="' .  $couleur . '">
            </div>
            <div class="form-group col-6">
                <label for="taille">Taille</label>
                <input type="number" class="form-control" id="taille" name="taille" placeholder="Saisir votre taille" value="' .  $taille . '">
            </div>
            <div class="form-group col-6">
                <label for="public">Sexe</label>
                <select class="form-control" id="public" name="public">
                    <option '; if($public == "m") echo "selected"; echo ' value="m">H</option>
                    <option '; if($public == "f") echo "selected"; echo ' value="f">F</option>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="photo">Photo</label>
                <input type="file" inputass="custom-file-input" id="photo" name="photo"  value= "'. $photo .'"><br>';

                if(!empty($photo))
                {
                    echo '<i> Vous pouvez uploader une nouvelle photo si vous souhaitez la changer</i><br>';
                    echo '<img src="' . $photo .'" width="90" height="90" value= "'. $photo .'"><br>';
                    }
                    echo '<input type="hidden" id="photo_actuelle" name="photo_actuelle" value="'. $photo . '">';
            echo '
            </div>
            <div class="form-group col-6">
                <label for="prix">Prix TTC</label>
                <input type="number" class="form-control" id="prix" name="prix" placeholder="Saisir le prix" value="' .  $prix . '">
            </div>
            <div class="form-group col-6">
                <label for="stock">Quantité</label>
                <input type="number" class="form-control" id="stock" name="stock" placeholder="Quantite" value="' .  $stock . '">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">' . ucfirst($_GET['action']) . ' d\'un produit</button>
            </div>
        </form>
    </div>
</div>';
} //fin de la condition d'affichage


require_once ("../inc/footer.inc.php");
?>
