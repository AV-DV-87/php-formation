<?php
echo '<pre>'; print_r($_GET);echo '<pre>';
//les informations passées dans l'url avec un id spécifique sera récupéré avec GET
$z = 1;
if ($_GET) {
    foreach ($_GET as $index => $info) {
        if($index!='id_produit') {
            echo '<table>';
            echo '<tr>' . $index . ' : ' . $info . '</tr>';
            echo '</table>';
        }
    }
}