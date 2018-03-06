<?php


//---------FONCTION DEBUG (fini les print_r et var_dump :] )

function debug($var, $mode = 1)
{
    echo '<div class="alert alert-danger my-2" role="alert">';
    //renvoi un tableau multi avec la ligne du debug
    $trace = debug_backtrace();
    //transsforme le tableau multi en tableau simple
    $trace = array_shift($trace);
//    echo '<pre>'; print_r($trace);echo '</pre>';
    echo "<p class='font-weight-bold'>Debug demandé dans le fichier : $trace[file] à la ligne $trace[line] </p><hr>";
    if ($mode === 1) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    } else {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }

    echo '</div>';
}

//--------- Verification de session ouverte
function internauteEstConnecte()
{
    if (!isset($_SESSION['membre'])) //si l'indice membre dans session n'est pas défini
        //l'internaute n'est pas passé par la page connexion
    {
        return false;
    }
    else
    {
        return true;
    }
}
//--------- Verification de utilisateur admin ou non
function internauteEstConnecteEtAdmin ()
{
    if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1)
    {
        return true;
    }
    else
    {
        return false;
    }
}

//--------- Ajout d'un panier dans la session
function creationDuPanier()
{
    if(!isset($_SESSION['panier'])) //si pas de tableau panier dans la session on le créé
    {
        $_SESSION['panier'] = array();
        $_SESSION['panier']['titre'] = array(); //un tableau pour chaque indice car on peut avoir plusieurs prod dans le panier
        $_SESSION['panier']['id_produit'] = array();
        $_SESSION['panier']['quantite'] = array();
        $_SESSION['panier']['prix'] = array();

    }
}
//-------------ajout des infos dans le panier de session
function ajouterProduitDansPanier($titre,$id_produit,$quantite,$prix)
{
    creationDuPanier();

    $position_produit = array_search($id_produit,$_SESSION['panier']['id_produit']) ;
    // TEST echo $position_produit;

    if($position_produit !== false) //MAJ SESSION panier si la position produit existe on additionne aux quantités déjà ajoutées au panier
    {
        $_SESSION['panier']['quantite'][$position_produit] += $quantite; //on MAJ la quantité à l'indice trouvé
    }
    else { // AJOUT si on l'a pas encore ajouté on créé l'entrée du panier
        $_SESSION['panier']['titre'][] = $titre; //[] permet d'ajouter des indices numériques par défaut
        $_SESSION['panier']['id_produit'][] = $id_produit;
        $_SESSION['panier']['quantite'][] = $quantite;
        $_SESSION['panier']['prix'][] = $prix;
    }
}


//--------MONTANT TOTAL
function montantTotal()
{
    $total = 0;
    for ($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) //la boucle tourne tant qu'il y des produits dans la session
    {
        $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
    }
    return round($total, 2);
}

//-------------RETRAIT D'UN PRODUIT DU PANIER
function retireProduitDuPanier($id_produit_a_supprimer)
{
    $position_produit = array_search($id_produit_a_supprimer, $_SESSION['panier']['id_produit']);
    // à quel indice est la valeur à supprimer dans la session panier

    if($position_produit !== false) //si le produit est trouvé dans le tableau on le supprime tout en faisant remonter
        // l'indice des autres produits avec array_splice
    {
        array_splice($_SESSION['panier']['titre'], $position_produit,1);
        array_splice($_SESSION['panier']['id_produit'], $position_produit,1);
        array_splice($_SESSION['panier']['quantite'], $position_produit,1);
        array_splice($_SESSION['panier']['prix'], $position_produit,1);

    }
}