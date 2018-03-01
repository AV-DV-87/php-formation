<?php
require_once ("inc/init.inc.php");

//si tentative de connexion sans être connecté redirection connexion
if(!internauteEstConnecte())
{
    header('location:connexion.php');
}
require_once ("inc/header.inc.php");
debug($_SESSION);
?>
<div class="row align-items-center my-4">
    <div class="col-6 offset-3">
        <ul class="list-group ">
            <li class="list-group-item active">PROFIL</li>
            <?php echo "<li class='list-group-item'>"; echo $_SESSION['membre']['pseudo']; echo "</li>";

                foreach ($_SESSION['membre'] as $indice=>$valeur)
                {
                    if($indice != 'indice' & $indice != 'statut' & $indice != 'id_membre') {
                        echo "<li class='list-group-item'>$indice : $valeur</li>";
                    }
                }
            ?>
        </ul>
    </div>
</div>


<?php
require_once ("inc/footer.inc.php");
?>
