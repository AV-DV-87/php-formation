<?php

require_once('inc/init.inc.php');

require_once('inc/header.inc.php');


?>


    <div class="row row-offcanvas row-offcanvas-right my-5">

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
            <div class="list-group">
            <p class="list-group-item active text-center">CATEGORIES</p>
            <?php
                //affichage des catégories en bouclant
                $resultat = $pdo->query('SELECT DISTINCT categorie FROM produit' );
                $resultat = $resultat->fetchAll(PDO::FETCH_ASSOC);
                //ou while( sur un Fetch simple)
//                debug($resultat);
                foreach ($resultat as $tableau) {
                    foreach ($tableau as $indice => $valeur) {
                        echo '<a href="?categorie='.$valeur.'" class="list-group-item">' . $valeur . '</a>';

                    }
                }
            ?>
            </div>
        </div><!--/.sidebar-offcanvas-->

        <div class="col-xs-12 col-sm-9">

            <div class="jumbotron">
                <h1>AV STORE</h1>
                <p>Bienvenue sur la boutique</p>
            </div>

            <!--si clique sur une catégorie on affiche le row avec les produits-->
            <?php if(isset($_GET['categorie'])):?>

            <div class="d-flex flex-row justify-content-between">
                <?php
                //affichage des catégories en bouclant
                $resultat = $pdo->prepare('SELECT DISTINCT * FROM produit WHERE categorie = :categorie' );
                $resultat->bindValue(':categorie', $_GET['categorie'], PDO::PARAM_STR);
                $resultat->execute();

                //ou while( sur un Fetch simple)

                while ($produit = $resultat->fetch(PDO::FETCH_ASSOC)):
                ?>
                <div class="card text-center" style="width: 18rem;">
                    <img class="card-img-top" src="<?= $produit['photo'] ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"> <?= $produit['titre']  ?></h5>
                        <p class="card-text"><?= $produit['description']?></p>
                        <a href="#" class="btn btn-primary">Acheter</a>
                        <a href="fiche_produit.php?id_produit=<?=$produit['id_produit']?>" class="btn btn-primary">Détails</a>
                    </div>
                </div>

                <?php endwhile; endif;?>
            </div>
        </div><!--/.col-xs-12.col-sm-9-->

    </div><!--/row-->


<?php

require_once('inc/footer.inc.php');