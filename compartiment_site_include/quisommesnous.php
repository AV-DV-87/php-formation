<?php
require_once ("inc/header.php"); //peut être remplacé par include once mais le require stop le code si pas d'occurence
require_once ("inc/nav.php"); //require est plu stricte
?>
    <nav>
        <a href="accueil.php">Accueil</a>
        <a href="actualites.php">Actualités</a>
        <a href="quisommesnous.php">Qui sommes nous?</a>
        <a href="contact.php">Contact</a>
    </nav>
    <section>
        Voici le contenu de la page Qui sommes nous<br>
        Voici le contenu de la page Qui sommes nous<br>
        Voici le contenu de la page Qui sommes noust<br>
        Voici le contenu de la page Qui sommes nous<br>

    </section>
<?php
require_once ("inc/footer.php");
?>