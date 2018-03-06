<?php
require_once ("inc/init.inc.php");


//Traitement ajout Panier
if (isset($_POST['ajout_panier']))
{

    $resultat = $pdo->query("SELECT * FROM produit WHERE id_produit = '$_POST[id_produit]'");
    $produit = $resultat->fetch(PDO::FETCH_ASSOC);
    ajouterProduitDansPanier($produit['titre'], $_POST['id_produit'], $_POST['quantite'], $produit['prix']);


}

//Paiement (+controle pre paiement)
if(isset($_POST['payer']))
{
    for($i=0; $i < count($_SESSION['panier']['id_produit']); $i++) {
        $resultat = $pdo->query("SELECT * FROM produit WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i]);
        $produit = $resultat->fetch(PDO::FETCH_ASSOC);
        // debug($produit);
        $erreur = '';
        //debug($produit);
        //si la quantite ajoutée au panier est inférieure à la quantité en stock envoie d'un message erreur
        if ($produit['stock'] < $_SESSION['panier']['quantite'][$i]) {

            $erreur .= '<hr><div class="alert alert-danger">Stock restant : ' . $produit['stock'] . '</div>';
            $erreur .= '<hr><div class="alert alert-danger">Quantité demandée : ' . $_SESSION['panier']['quantite'][$i] . '</div>';

            if ($produit['stock'] > 0)
            {
                $erreur .= '<hr><div class="alert alert-danger">La quantité du produit <strong>' . $_SESSION['panier']['titre'][$i] .  '</strong>
                a été réduite car notre stock est insuffisant, veuillez vérifier vos achats.</div>';
                $_SESSION['panier']['quantite'][$i] = $produit['stock']; // modifie la quantite par le restant de stock
            }
            else
            {
                $erreur .='<hr><div class="alert alert-danger">Le produit <strong>' . $_SESSION['panier']['titre'][$i] .  '</strong>
                a été supprimé car notre stock est insuffisant, veuillez vérifier vos achats.</div>';

                retireProduitDuPanier($_SESSION['panier']['id_produit'][$i]);
                $i--; //permet de contrôler le produit qui a été remonter dans la liste après suppression du produit concerné
            }
            $content .= $erreur;
        }
    }

    if (empty($erreur)) //si les produits du panier sont bien disponibles on ajoute dans la table commande
    {
        $resultat = $pdo->exec("INSERT INTO commande(id_membre, montant, date_enregistrement)VALUES(" .$_SESSION['membre']['id_membre'].","
        . montantTotal().", NOW())");
        $id_commande = $pdo->lastInsertId();
        echo $id_commande;
        for ($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
        {
            $resultat = $pdo->exec("INSERT INTO details_commande(id_commande,id_produit,quantite,prix) 
            VALUES ($id_commande, ". $_SESSION['panier']['id_produit'][$i].",". $_SESSION['panier']['quantite'][$i] .",". $_SESSION['panier']['prix'][$i] .")");
            $resultat = $pdo->exec("UPDATE produit SET stock = stock -". $_SESSION['panier']['quantite'][$i] . "
            WHERE id_produit = ". $_SESSION['panier']['id_produit'][$i]);
        }
        unset($_SESSION['panier']); //on vide le panier la commande est passé en BDD dans la table commande et details commande
        $content .= '<hr><div class="alert alert-success text-center">Votre commande a bien été validée. Votre n° de commande est le 
        <strong>'. $id_commande . '</strong></div>';

    }
}

//Traitement vider le panier
if(isset($_GET['action']) && $_GET['action'] == 'vider')
{
    unset ($_SESSION['panier']);
}

//traitement supprimer un produit du panier
if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
    retireProduitDuPanier($_GET['id_produit']);

    $resultat = $pdo->prepare("SELECT * FROM produit WHERE id_produit = :id_produit");
    $resultat->bindValue(':id_produit', $_GET['id_produit'], PDO::PARAM_STR);
    $resultat->execute();
    $produit_supp = $resultat->fetch(PDO::FETCH_ASSOC);

    $content .= '<hr><div class="alert alert-success text-center">Le produit <strong>'. $produit_supp['titre'] .'</strong> a bien été supprimé du panier.</div>';
}

require_once ('inc/header.inc.php');
echo $content;
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
                echo '<form method="post"><a href=""><button class="btn btn-primary" type="submit" name="payer">Valider le paiement</button></a></form> ';

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
