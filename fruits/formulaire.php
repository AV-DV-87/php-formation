<?php
/**
 * Exercice :
 * 1 - réaliser un formulaire permettant de selectionner un fruit et saisir un poids
 * 2 - réaliser un traitement permettant d'afficher le prix en passant par la fonction déclarée calcul
 *
 */

if ($_POST) {
    include('fonction.inc.php');
    echo '<pre>'; print_r($_POST); echo '<pre>';
    echo calcul($_POST['choixfruits'], $_POST['poids']);
}
?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Calcul du prix des fruits</title>
</head>
<body>
<div class="container-fluid">
    <form method="post">
        <div class="form-group">
            <label for="poids">Saisir le poids</label>
            <input type="text" class="form-control" id="poids" name="poids" placeholder="poids en gramme"
            value="<?php if (isset($_POST['poids'])){echo $_POST['poids'];}?>">
        </div>
        <div class="form-group">
            <label for="choixfruits">Choisir un fruit</label>
            <select class="form-control" id="choixfruits" name="choixfruits">
                <option value="cerises"<?php if(isset($_POST['choixfruits']) && $_POST['choixfruits'] == 'cerises') echo 'selected="selected"';?>>Cerises</option>
                <option value="bananes"<?php if(isset($_POST['choixfruits']) && $_POST['choixfruits'] == 'bananes') echo 'selected="selected"';?>>Bananes</option>
                <option value="pommes"<?php if(isset($_POST['choixfruits']) && $_POST['choixfruits'] == 'pommes') echo 'selected="selected"';?>>Pommes</option>
                <option value="peches"<?php if(isset($_POST['choixfruits']) && $_POST['choixfruits'] == 'peches') echo 'selected="selected"';?>>Pêches</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary mb-2">Calculer le prix</button>
        </div>
    </form>
</div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
