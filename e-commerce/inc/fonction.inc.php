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