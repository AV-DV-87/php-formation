<?php
require_once ("inc/header.php"); //peut être remplacé par include once mais le require stop le code si pas d'occurence
require_once ("inc/nav.php"); //require est plus stricte
//le once vérifie si le fichier a déjà été inclus, si vrai il ne l'inclu pas
?>
    <nav>
        <a href="accueil.php">Accueil</a>
        <a href="actualites.php">Actualités</a>
        <a href="quisommesnous.php">Qui sommes nous?</a>
        <a href="contact.php">Contact</a>
    </nav>
    <section>
        Voici le contenu de la page Contact<br>
        Voici le contenu de la page Contact<br>
        Voici le contenu de la page Contact<br>
        Voici le contenu de la page Contact<br>

    </section>
<?php
require_once ("inc/footer.php");
?>