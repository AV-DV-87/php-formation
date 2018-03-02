<?php
require_once ("inc/init.inc.php");


//Traitement ajout Panier
if (isset($_POST['ajout_panier']))
{

    $resultat = $pdo->query("SELECT * FROM produit WHERE id_produit = '$_POST[id_produit]'");
    $produit = $resultat->fetch(PDO::FETCH_ASSOC);
    ajouterProduitDansPanier($produit['titre'], $_POST['id_produit'], $_POST['quantite'], $produit['prix']);


}

require_once ('inc/header.inc.php');
?>

<div class="col">
    <table class="table">
        <h2>PANIER</h2>
        <thead><tr><th>Titre</th><th>Quantité</th><th>Prix unitaire</th><th>Prix Total</th><th>Supprimer</th></tr></thead>
        <?php
        //condition panier vide
        if(empty($_SESSION['panier']['id_produit']))
        {
            echo '<tr><td colspan="5"><div class="alert alert-danger text-center">Votre Panier est Vide</div></td></tr>';
        }
        //condition panier actif
        else
        {
            for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
            {
                echo '<tbody><tr>';
                echo '<td>' . $_SESSION['panier']['titre'][$i] . '</td>';
                echo '<td>' . $_SESSION['panier']['quantite'][$i] . '</td>';
                echo '<td>' . $_SESSION['panier']['prix'][$i] . ' €</td>';
                echo '<td>' . $_SESSION['panier']['prix'][$i]*$_SESSION['panier']['quantite'][$i] . ' €</td>';
                echo '<td><a href="?action=suppression&id_produit='. $_SESSION['panier']['id_produit'][$i] .'" onclick="return(confirm(\'En êtes vous certain?\'));"><i class="fas fa-trash-alt"></i></a>';
                echo '</tr></tbody>';

            }
            echo '<tr><th colspan="3 class="text-right">Total</th><td colspan="2">'.montantTotal().' €</td></tr></table>';
            //VERIF internaute connecté pour se connecter ou pour aller vers le paiement
            if (internauteEstConnecte())
            {
                echo '<div class="row d-flex justify-content-center">';
                echo '<a href="connexion.php.php"><button class="btn btn-primary">Valider le paiement</button></a>';

            }

            else
            {
                echo '<div class="row>';
                echo '<a href="inscription.php"><button class="btn btn-primary">Inscription</button></a>';
                echo '<a href="connexion.php"><button class="btn btn-primary ml-4">Connexion</button></a>';

            }
            echo '<a href="?action=vider" onclick="return(confirm(\'En êtes vous certain?\'));"><button class="btn btn-danger ml-4">Vider mon panier</button></a>';
            echo '</div>';

        }
        ?>


</div>







<?php require_once ("inc/footer.inc.php");
