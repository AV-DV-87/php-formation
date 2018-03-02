<?php
require_once ('inc/init.inc.php');
require_once ('inc/header.inc.php');



?>

<?php if(isset($_GET['id_produit'])):?>

<div class="row my-5 py-4 border border-primary rounded">
    <?php
    $resultat = $pdo->prepare('SELECT DISTINCT * FROM produit WHERE id_produit = :id_produit' );
    $resultat->bindValue(':id_produit', $_GET['id_produit'], PDO::PARAM_STR);
    $resultat->execute();

    //condition pour éviter que l'utilisateur change l'id produit dans l'url et tombe sur page erronée
    //si id inconnu retour sur la page Boutique
    if($resultat->rowCount() <= 0)
    {
        header("location:boutique.php");
        exit();
    }

   $produit = $resultat->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="col-4">
        <img src="<?=$produit['photo']?>" alt="" class="img-thumbnail">
    </div>
    <div class="col-8 my-auto">
        <h2><?=$produit['titre']?></h2>
        <ul class="list-group list-group-flush my-2">
            <li class="list-group-item"><?=$produit['prix']?> €</li>
            <li class="list-group-item"><?=$produit['description']?></li>
            <li class="list-group-item">Catégorie : <?=$produit['categorie']?></li>
            <li class="list-group-item">Taille : <?=$produit['taille']?> -Couleur : <?=$produit['couleur']?></li>
        </ul>
        <?php if($produit['stock'] > 0): ?>
        <form method="post" action="panier.php" class="row d-flex flex-row justify-content-center pt-2 px-4">

            <div class="form-group">
            <input type="hidden" name="id_produit" value="<?= $produit['id_produit']?>"
            </div>

            <div class="form-group">
                <label for="quantite" >Quantité</label>
                <select class="form-control" id="quantite" name="quantite">
                    <?php
                    for ($i=1; $i <= $produit['stock'] && $i <=5; $i++) {
                        echo "<option>$i</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-4" name="ajout_panier" value="ajout_panier">Ajouter au panier</button>
        </form>
        <?php else: ?>
        <div class="alert alert-danger">Rupture de stock !!!</div>

        <?php endif; ?>
    </div>

</div>

<?php
endif;
require_once ('inc/footer.inc.php');
?>
